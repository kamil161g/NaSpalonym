<?php
/**
 * Created by PhpStorm.
 * User: kamil
 * Date: 17.12.17
 * Time: 13:39
 */

namespace App\Controller;


use App\Entity\Team;
use App\Form\searchTeamType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class searchTeamController extends Controller
{

    public function searchTeamAction(Request $request)
    {

        $form = $this->createForm(searchTeamType::class);

        $form->handleRequest($request);

        if($form->isSubmitted()){

            $name = addcslashes($name = $form->get('name')->getData(), "%_");

            $result = $this->getDoctrine()
                ->getRepository(Team::class)
                ->searchTeam($name);

            return $this->render("Teams/searchTeam.html.twig",[
                'form' => $form->createView(),
                'result' => $result
            ]);
        }


        return $this->render("Teams/searchTeam.html.twig",[
            'form' => $form->createView()
        ]);
    }

}