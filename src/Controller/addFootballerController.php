<?php


namespace App\Controller;


use App\Entity\Footballer;
use App\Form\addFootballerType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class addFootballerController extends Controller
{

    public function addFootballerAction(Request $request)
    {
        $fooballer = new Footballer();
        $form = $this->createForm(addFootballerType::class, $fooballer);

        $form->handleRequest($request);

            if($form->isSubmitted() && ($form->isValid())){

                    $this->getDoctrine()->getRepository(Footballer::class)
                        ->addDetailsFootballer($fooballer);

                return $this->redirectToRoute('app_add_fb');
            }

            return $this->render('Footballers/addFootballer.html.twig', [
                'form' => $form->createView()
            ]);

    }

}