<?php
/**
 * Created by PhpStorm.
 * User: kamil
 * Date: 17.12.17
 * Time: 14:07
 */

namespace App\Controller;


use App\Entity\InformationFb;
use App\Entity\InformationTeam;
use App\Entity\Team;
use App\Form\ChooseSeasonTeamType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class detailsTeamController extends Controller
{

    public function detailsTeamAction($team, InformationTeam $informationTeam, Request $request)
    {

        $form = $this->createForm(ChooseSeasonTeamType::class, $informationTeam,  ['team' => $team]);

        $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){

                $season = $form->get('plainSeason')->getViewData();

                $result = $this->getDoctrine()
                    ->getRepository(Team::class)
                    ->detailsTeam($team);

                $detailsFb = $this->getDoctrine()
                    ->getRepository(InformationFb::class)
                    ->detailsForTeam($team);

                $herb = $this->getDoctrine()
                    ->getRepository(InformationTeam::class)
                    ->findOneBy(['team' => $team, 'season' => $season]);

                return $this->render("Teams/details.html.twig",[
                    'form' => $form->createView(),
                    'result' => $result,
                    'squad' => $detailsFb,
                    'herb' => $herb,
                    'id' => $team
                ]);
            }


        return $this->render("Teams/details.html.twig",[
            'form' => $form->createView(),
            'id' => $team
        ]);
    }

}