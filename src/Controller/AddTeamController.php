<?php
/**
 * Created by PhpStorm.
 * User: kamil
 * Date: 27.05.18
 * Time: 11:06
 */

namespace App\Controller;


use App\Entity\InformationTeam;
use App\Entity\Team;
use App\Form\AddTeamType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AddTeamController extends Controller
{

    public function addTeamAction(Request $request)
    {

        $team = new Team();
        $informationTeam = new InformationTeam();
        $season = $this->getParameter("season.global_param");

        $form = $this->createForm(AddTeamType::class, $team);

        $form->handleRequest($request);

            if($form->isSubmitted() && ($form->isValid())){

                $this->getDoctrine()
                    ->getRepository(Team::class)
                    ->addDetailsTeam($team);

                $id = $this->getDoctrine()
                    ->getRepository(Team::class)
                    ->serachAndOrder();

                    $this->getDoctrine()
                    ->getRepository(InformationTeam::class)
                    ->addDefault($informationTeam, $team, $season);


                return $this->redirectToRoute('app_edit_details_team', ['team' => $id->getId()]);
            }

        return $this->render('Teams/addTeam.html.twig', [
            'form' => $form->createView()
        ]);

    }

}