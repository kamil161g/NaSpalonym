<?php
/**
 * Created by PhpStorm.
 * User: kamil
 * Date: 23.05.18
 * Time: 17:03
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Footballer;
use App\Entity\InformationFb;
use App\Entity\Matchs;
use App\Entity\Shooter;
use App\Entity\Team;
use App\Form\changeScoreType;
use Symfony\Component\HttpFoundation\Request;

class AddGoalMatchController extends Controller
{

    public function ChangeScoreAction(Matchs $matchs, Request $request, $id)
    {
        $shooter = new Shooter();

        $searchTeams = $this->getDoctrine()
            ->getRepository(Matchs::class)
            ->searchTeams($id);

        $searchIdHost = $this->getDoctrine()
            ->getRepository(Team::class)
            ->searchId($searchTeams->getHostTeam());

        $searchIdGuest = $this->getDoctrine()
            ->getRepository(Team::class)
            ->searchId($searchTeams->getGuestTeam());



        $form = $this->createForm(changeScoreType::class, null, [
            'id' => $searchIdHost->getId(),
            'id2' => $searchIdGuest->getId(),
        ]);

        $form->handleRequest($request);

        if($form->isSubmitted()) {

            $hostName = $form->get('hostName')->getData();
            $guestName = $form->get('guestName')->getData();

            if (!empty($hostName) && !empty($guestName)) {

                $this->addFlash("error", "Wybierz tylko jednego zawodnika.");

            } else {

                if(!empty($hostName) && empty($guestName)) {

                    $fbHost = $form->get('hostName')->getData();

                    $findFb = $this->getDoctrine()
                        ->getRepository(Footballer::class)
                        ->findFbForScore($fbHost->getFootballer()->getId());

                }else{

                    $fbHost = $form->get('guestName')->getData();

                    $findFb = $this->getDoctrine()
                        ->getRepository(Footballer::class)
                        ->findFbForScore($fbHost->getFootballer()->getId());
                }

                $goalHost = $form->get('goalHost')->getData();
                $goalGuest = $form->get('goalGuest')->getData();
                $minutes = $form->get('minutes')->getData();


                $this->getDoctrine()->getRepository(Shooter::class)
                    ->addShooter($findFb,$matchs,$minutes,$shooter);

                $this->getDoctrine()->getRepository(Matchs::class)
                    ->addGoals($matchs, $goalHost, $goalGuest);


                $season = $this->getParameter("season.global_param");

                $searchIfb = $this->getDoctrine()
                    ->getRepository(InformationFb::class)
                    ->findOneBy(['footballer' => $findFb->getId(), 'season' => $season]);

                $this->getDoctrine()
                    ->getRepository(InformationFb::class)
                    ->addGoalForShooter($searchIfb);



                return $this->redirectToRoute("app_details_match", [
                    'id' => $id
                ]);

            }
        }


        return $this->render('Matchs/beforeChangeScore.html.twig', [
            'form' => $form->createView(),
        ]);

    }

}