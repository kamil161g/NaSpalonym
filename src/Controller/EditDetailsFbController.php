<?php
/**
 * Created by PhpStorm.
 * User: kamil
 * Date: 19.05.18
 * Time: 16:51
 */

namespace App\Controller;


use App\Entity\Footballer;
use App\Entity\InformationFb;
use App\Form\addDetailsFbType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class EditDetailsFbController extends Controller
{

    public function editDetailsAction(Footballer $footballer, Request $request)
    {

        $this->denyAccessUnlessGranted(['ROLE_ADMIN', 'ROLE_MODERATOR'], null, 'Brak dostępu.');

        $informationFb = new InformationFb();


        $form = $this->createForm(addDetailsFbType::class, $informationFb);


        $form->handleRequest($request);

            if($form->isSubmitted()){

                    $file = $informationFb->getBrochure();

                    if(!empty($file)) {

                        $fileName = $this->generateUniqueFileName() . '.' . $file->guessExtension();


                        $file->move(
                            $this->getParameter('brochures_directory'),
                            $fileName
                        );


                        $informationFb->setBrochure($fileName);
                    }

                    $club = $form->get('club')->getData();
                    $season = $form->get('season')->getViewData();
                    $seasonDefault = 'Nie podano informajci';



                    $searchFb = $this->getDoctrine()
                        ->getRepository(InformationFb::class)
                        ->searchFb($footballer, $season);

                    $searchFbDefault = $this->getDoctrine()
                        ->getRepository(InformationFb::class)
                        ->searchFb($footballer, $seasonDefault);


                        if(!empty($searchFb)) {

                            $em = $this->getDoctrine()->getManager();
                            $em->remove($searchFb);

                            $this->addFlash('error','Edytowałeś sezon: '.$season);

                        }

                        if(!empty($searchFbDefault)){
                            $em = $this->getDoctrine()->getManager();
                            $em->remove($searchFbDefault);
                        }

                    $this->getDoctrine()
                        ->getRepository(InformationFb::class)
                       ->addDetailsFb($informationFb,$club,$footballer);

                return $this->redirectToRoute("app_details_fb",['footballer' => $footballer->getId()]);

            }


        return $this->render('Footballers/edit.html.twig',[
            'form' => $form->createView(),
        ]);
    }

    /**
     * @return string
     */
    private function generateUniqueFileName()
    {

        return md5(uniqid());
    }


}