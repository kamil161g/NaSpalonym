<?php

namespace App\Controller;


use App\Entity\Matchs;
use App\Form\addMatchType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class addMatchController extends Controller
{

    public function createAction(Request $request)
    {
        $match = new Matchs();

         $form = $this->createForm(addMatchType::class, $match);

            $form->handleRequest($request);

                if ($form->isSubmitted()) {


                    $time = $form->get('startMatch')->getData();
                    $timeToModify = clone $time;
                    $timeToModify->modify('+2 hours');


                    $this->getDoctrine()
                        ->getRepository(Matchs::class)
                        ->addMatch($match,$timeToModify);

                    return $this->redirectToRoute("app_add_match");

                }

        return $this->render(
            'Matchs/addMatch.html.twig',
            array('form' => $form->createView())
        );
    }

}