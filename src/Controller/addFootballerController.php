<?php


namespace App\Controller;


use App\Entity\Footballer;
use App\Entity\InformationFb;
use App\Form\addFootballerType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class addFootballerController extends Controller
{

    public function addFootballerAction(Request $request)
    {
        $fooballer = new Footballer();
        $informationFb = new InformationFb();
        $form = $this->createForm(addFootballerType::class, $fooballer);

        $form->handleRequest($request);

            if($form->isSubmitted() && ($form->isValid())){

                    $this->getDoctrine()
                         ->getRepository(Footballer::class)
                         ->addDetailsFootballer($fooballer);

                    $id = $this->getDoctrine()
                        ->getRepository(Footballer::class)
                        ->searchId();


                return $this->redirectToRoute('app_edit_details', ['footballer' => $id->getId()]);
            }

            return $this->render('Footballers/addFootballer.html.twig', [
                'form' => $form->createView()
            ]);

    }

}