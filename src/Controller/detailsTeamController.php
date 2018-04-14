<?php
/**
 * Created by PhpStorm.
 * User: kamil
 * Date: 17.12.17
 * Time: 14:07
 */

namespace App\Controller;


use App\Entity\InformationFb;
use App\Entity\Team;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class detailsTeamController extends Controller
{

    public function detailsTeamAction($id)
    {


        $result = $this->getDoctrine()
            ->getRepository(Team::class)
            ->detailsTeam($id);

        $detailsFb = $this->getDoctrine()
            ->getRepository(InformationFb::class)
            ->detailsForTeam($id);

        return $this->render("Teams/details.html.twig",[
            'result' => $result,
            'squad' => $detailsFb
        ]);
    }

}