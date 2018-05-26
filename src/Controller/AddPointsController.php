<?php
/**
 * Created by PhpStorm.
 * User: kamil
 * Date: 24.05.18
 * Time: 09:49
 */

namespace App\Controller;


use App\Entity\InformationTeam;
use App\Entity\Matchs;
use App\Entity\Team;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AddPointsController extends Controller
{

    public function addPointsAction($id)
    {

        $details = $this->getDoctrine()
            ->getRepository(Matchs::class)
            ->findOneBy(['id' => $id]);

        $searchTime = $this->getDoctrine()
            ->getRepository(Matchs::class)
            ->findOneBy(['id' => $id]);

          $host = $searchTime->getHostTeam();
          $guest = $searchTime->getGuestTeam();

                 $season = $this->getParameter("season.global_param");



                $searchIdGuest = $this->getDoctrine()
                    ->getRepository(Team::class)
                    ->findOneBy(['name' => $guest]);



                $searchIdHost = $this->getDoctrine()
                    ->getRepository(Team::class)
                    ->findOneBy(['name' => $host]);



                $detailsHost = $this->getDoctrine()
                    ->getRepository(InformationTeam::class)
                    ->findOneBy(['id' => $searchIdHost,
                        'season' => $season]);



                $detailsGuest = $this->getDoctrine()
                    ->getRepository(InformationTeam::class)
                    ->findOneBy(['id' => $searchIdGuest,
                        'season' => $season]);

                $goalHost = $searchTime->getGoalHost();
                $goalGuest = $searchTime->getGoalGuest();



        if($searchTime->getGoalHost() > $searchTime->getGoalGuest()){


             $this->getDoctrine()
                 ->getRepository(InformationTeam::class)
                 ->addPointsHost($detailsHost, $searchTime, $detailsGuest, $goalHost, $goalGuest);


        }if($searchTime->getGoalHost() < $searchTime->getGoalGuest()){


            $this->getDoctrine()
                ->getRepository(InformationTeam::class)
                ->addPointsGuest($detailsHost, $searchTime, $detailsGuest, $goalGuest, $goalHost);

        }if($searchTime->getGoalHost() === $searchTime->getGoalGuest()){

        $this->getDoctrine()
            ->getRepository(InformationTeam::class)
            ->addDraw($detailsHost, $searchTime, $detailsGuest, $goalHost, $goalGuest);
    }


    $this->getDoctrine()
        ->getRepository(Matchs::class)
        ->addStatus($details);

    return $this->redirectToRoute("app_details_match", ['id' => $id]);

    }

}