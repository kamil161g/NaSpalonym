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

        $informationFb = new InformationFb();

        $form = $this->createForm(addDetailsFbType::class, $informationFb);

        $form->handleRequest($request);

        if($form->isSubmitted()){

            $club = $form->get('club')->getData();
            $season = $form->get('season')->getViewData();



            $searchFb = $this->getDoctrine()
                ->getRepository(InformationFb::class)
                ->searchFb($footballer, $season);



            if(!empty($searchFb)) {

                $em = $this->getDoctrine()->getManager();
                $em->remove($searchFb);

                $this->addFlash('error','Edytowałeś sezon: '.$season);

            }

                $this->getDoctrine()
                    ->getRepository(InformationFb::class)
                   ->addDetailsFb($informationFb,$club,$footballer);

            $this->addFlash('success', 'Operacja wykonana prawidłowo.');

        }


        return $this->render('Footballers/edit.html.twig',[
            'form' => $form->createView(),
        ]);
    }


}