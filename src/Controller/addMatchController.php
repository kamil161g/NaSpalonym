<?php

namespace App\Controller;


use App\Entity\Matchs;
use App\Form\addMatchType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class addMatchController extends Controller
{

    public function addMatchAction(Request $request)
    {
        $match = new Matchs();

            $form = $this->createForm(addMatchType::class, $match);

                $form->handleRequest($request);

                    if($form->isSubmitted()){

                            $this->getDoctrine()
                            ->getRepository(Matchs::class)
                            ->addMatch($match);

                        return $this->redirectToRoute('app_show_match');

                    }

        return $this->render("Matchs/addMatch.html.twig", ['form' => $form->createView()]);
    }

}