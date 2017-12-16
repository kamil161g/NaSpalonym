<?php


namespace App\Controller;


use App\Entity\Footballer;
use App\Form\addDetailsFootballerType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class addDetailsFootballerController extends Controller
{

    public function addDetailsAction(Request $request)
    {
        $fooballer = new Footballer();
        $form = $this->createForm(addDetailsFootballerType::class, $fooballer);

        $form->handleRequest($request);

            if($form->isSubmitted() && ($form->isValid())){

                    $this->getDoctrine()->getRepository(Footballer::class)
                        ->addDetailsFootballer($fooballer);

                return $this->redirectToRoute('app_add_details_fb');
            }

            return $this->render('Footballers/addDetails.html.twig', [
                'form' => $form->createView()
            ]);

    }

}