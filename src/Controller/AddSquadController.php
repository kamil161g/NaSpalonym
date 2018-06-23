<?php

namespace App\Controller;


use App\Entity\Matchs;
use App\Entity\PlayTime;
use App\Entity\Team;
use App\Form\AddSquadType;
use App\Form\DeleteSquadType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AddSquadController extends Controller
{

    public function addSquadAction($id, Request $request, Matchs $matchs)
    {

        $searchTeams = $this->getDoctrine()
            ->getRepository(Matchs::class)
            ->searchTeams($id);

        $searchIdHost = $this->getDoctrine()
            ->getRepository(Team::class)
            ->searchId($searchTeams->getHostTeam());

        $searchIdGuest = $this->getDoctrine()
            ->getRepository(Team::class)
            ->searchId($searchTeams->getGuestTeam());

        $season = $this->getParameter("season.global_param");

        $form = $this->createForm(AddSquadType::class, null, [
            'id' => $searchIdHost->getId(),
            'id2' => $searchIdGuest->getId(),
            'season' => $season,
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $hosts = $form->get('hosts')->getData();
            $guests = $form->get('guests')->getData();
            $clubH = $searchIdHost;
            $clubG = $searchIdGuest;



            foreach ($hosts as $item) {

                $searchFbHost = $this->getDoctrine()
                    ->getRepository(PlayTime::class)
                    ->findBy([
                        'footballer' => $item->getFootballer(),
                        'club' => $clubH,
                        'match' => $matchs,
                        ]);

            }

            foreach ($guests as $item) {

                $searchFbGuest = $this->getDoctrine()
                    ->getRepository(PlayTime::class)
                    ->findBy([
                        'footballer' => $item->getFootballer(),
                        'club' => $clubG,
                        'match' => $matchs,
                    ]);

            }



            if (empty($searchFbHost) && empty($searchFbGuest)) {

                $number2 = 1;
                foreach ($hosts as $item) {

                    $playTime = new PlayTime();
                    $em = $this->getDoctrine()->getManager();

                    $playTime->setFootballer($item->getFootballer());
                    $playTime->setClub($clubH);
                    $playTime->setMatch($matchs);
                    if($number2 <= 2)
                    $playTime->setPlay(1);
                    else
                    $playTime->setPlay(0);
                    $em->persist($playTime);
                    $em->flush();

                    $number2++;
                }


                $number3 = 1;
                foreach ($guests as $item) {


                    $playTime = new PlayTime();
                    $em = $this->getDoctrine()->getManager();

                    $playTime->setFootballer($item->getFootballer());
                    $playTime->setClub($clubG);
                    $playTime->setMatch($matchs);
                    if($number3 <= 2)
                        $playTime->setPlay(1);
                    else
                        $playTime->setPlay(0);
                    $em->persist($playTime);
                    $em->flush();

                    $number3++;
                }

                $number = 1;
                foreach ($hosts as $value) {

                        $em = $this->getDoctrine()->getManager();
                        if($number <= 2)
                        $value->setMatchs($value->getMatchs() + 1);
                        $em->persist($value);
                        $em->flush();

                    $number++;


                }

                $number4 = 1;
                foreach ($guests as $value) {

                    $em = $this->getDoctrine()->getManager();
                    if($number4 <= 2)
                        $value->setMatchs($value->getMatchs() + 1);
                    $em->persist($value);
                    $em->flush();

                    $number4++;


                }
            }


            return $this->redirectToRoute("app_details_match",['id' => $id]);

        }


        return $this->render("Matchs/addSquad.html.twig", [
            'form' => $form->createView(),
        ]);
    }

    public function deleteSquadAction($id, Request $request, Matchs $matchs)
    {

        $searchTeams = $this->getDoctrine()
            ->getRepository(Matchs::class)
            ->searchTeams($id);

        $searchIdHost = $this->getDoctrine()
            ->getRepository(Team::class)
            ->searchId($searchTeams->getHostTeam());

        $searchIdGuest = $this->getDoctrine()
            ->getRepository(Team::class)
            ->searchId($searchTeams->getGuestTeam());


        $form = $this->createForm(DeleteSquadType::class, null, [
            'clubH' => $searchIdHost->getId(),
            'clubG' => $searchIdGuest->getId(),
            'match' => $id,
        ]);

            $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $hosts = $form->get('hosts')->getData();
            $guests = $form->get('guests')->getData();


            foreach ($hosts as $item) {

                $em = $this->getDoctrine()->getManager();
                $em->remove($item);
                $em->flush();

            }

            foreach ($guests as $item) {

                $em = $this->getDoctrine()->getManager();
                $em->remove($item);
                $em->flush();

            }

            return $this->redirectToRoute("app_details_match",['id' => $id]);

        }

        return $this->render("Matchs/addSquad.html.twig",[
            'form' => $form->createView(),
        ]);

    }

}