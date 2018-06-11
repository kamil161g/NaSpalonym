<?php

namespace App\Controller;


use App\Entity\InformationFb;
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


        $form = $this->createForm(AddSquadType::class, null, [
            'id' => $searchIdHost->getId(),
            'id2' => $searchIdGuest->getId(),
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $hosts = $form->get('hosts')->getData();
            $guests = $form->get('guests')->getData();
            $clubH = $searchIdHost;
            $clubG = $searchIdGuest;
            $season = $this->getParameter("season.global_param");

            //            $this->getDoctrine()
            //                ->getRepository(PlayTime::class)
            //                ->add($footballer, $club, $id, $playTime);
            foreach ($hosts as $item) {

                $searchFb = $this->getDoctrine()
                    ->getRepository(PlayTime::class)
                    ->findBy([
                        'footballer' => $item->getFootballer(),
                        'club' => $clubH,
                        'match' => $matchs]);

                $searchInformationFb = $this->getDoctrine()
                    ->getRepository(InformationFb::class)
                    ->findBy([
                        'footballer' => $item->getFootballer(),
                        'season' => $season]);

                foreach ($searchInformationFb as $item) {

                    $em = $this->getDoctrine()->getManager();
                    $item->setMatchs($item->getMatchs()+1);
                    $em->persist($item);
                    $em->flush();
                }



            }


            if (empty($searchFb)) {


                foreach ($hosts as $item) {

                    $playTime = new PlayTime();
                    $em = $this->getDoctrine()->getManager();

                    $playTime->setFootballer($item->getFootballer());
                    $playTime->setClub($clubH);
                    $playTime->setMatch($matchs);
                    $em->persist($playTime);
                    $em->flush();
                }


                foreach ($guests as $item) {


                    $playTime = new PlayTime();
                    $em = $this->getDoctrine()->getManager();

                    $playTime->setFootballer($item->getFootballer());
                    $playTime->setClub($clubG);
                    $playTime->setMatch($matchs);
                    $em->persist($playTime);
                    $em->flush();
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

            $this->redirectToRoute("app_delete_squad",['id' => $id]);
            $this->addFlash("success", "Pomyślnie usunięto. Odśwież stronę.");

        }

        return $this->render("Matchs/addSquad.html.twig",[
            'form' => $form->createView(),
        ]);

    }

}