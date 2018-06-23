<?php
/**
 * Created by PhpStorm.
 * User: kamil
 * Date: 08.06.18
 * Time: 13:37
 */

namespace App\Controller;


use App\Entity\InformationFb;
use App\Entity\Matchs;
use App\Entity\PlayTime;
use App\Entity\Team;
use App\Form\ChangeFbType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ChangeFootballerController extends Controller
{

    public function chagneFbHostAction($id, Request $request, Matchs $matchs)
    {

        $searchTeams = $this->getDoctrine()
            ->getRepository(Matchs::class)
            ->searchTeams($id);

        $searchIdHost = $this->getDoctrine()
            ->getRepository(Team::class)
            ->searchId($searchTeams->getHostTeam());


        $form = $this->createForm(ChangeFbType::class, null, [
            'id' => $searchIdHost->getId(),
            'id2' => $searchIdHost->getId(),
            'id3' => $id,
        ]);

            $form->handleRequest($request);

                if($form->isSubmitted() && $form->isValid()) {

                    $hosts = $form->get('hosts')->getData();
                    $hostsNew = $form->get('guests')->getData();
                    $description = $form->get('description')->getViewData();
                    $clubH = $searchIdHost;



                        $season = $this->getParameter("season.global_param");

                        $searchInformationFb = $this->getDoctrine()
                            ->getRepository(InformationFb::class)
                            ->findBy([
                                'footballer' => $hosts[0]->getFootballer(),
                                'season' => $season]);

                    $searchInformationFbNew = $this->getDoctrine()
                        ->getRepository(PlayTime::class)
                        ->findOneBy([
                            'footballer' => $hostsNew[0]->getFootballer(),
                            'match' => $matchs,
                            'club' => $clubH
                        ]);

                        $em = $this->getDoctrine()->getManager();
                        $searchInformationFb[0]->setMatchs($searchInformationFb[0]->getMatchs() + 1);
                        $em->persist($searchInformationFb[0]);
                        $em->flush();


                        if (!empty($hosts) && !empty($hostsNew)) {

                            $searchPlayFb = $this->getDoctrine()
                                ->getRepository(PlayTime::class)
                                ->findOneBy([
                                    'footballer' => $hosts[0]->getFootballer(),
                                    'club' => $clubH,
                                    'match' => $matchs
                                ]);
                            $em = $this->getDoctrine()->getManager();
                            $searchPlayFb->setPlay(3);
                            $searchInformationFbNew->setPlay(1);
                            $searchInformationFbNew->setDescription($description);
                            $em->persist($searchInformationFbNew);
                            $em->persist($searchPlayFb);
                            $em->flush();


                            return $this->redirectToRoute("app_details_match", ['id' => $id]);
                        } else

                            $this->addFlash("error", "Wybierz zawodników.");

                    }

         return $this->render("Matchs/addSquad.html.twig", [
             'form' => $form->createView()
         ]);

    }

    public function chagneFbGuestAction($id, Request $request, Matchs $matchs)
    {

        $searchTeams = $this->getDoctrine()
            ->getRepository(Matchs::class)
            ->searchTeams($id);

        $searchIdGuest = $this->getDoctrine()
            ->getRepository(Team::class)
            ->searchId($searchTeams->getGuestTeam());


        $form = $this->createForm(ChangeFbType::class, null, [
            'id' => $searchIdGuest->getId(),
            'id2' => $searchIdGuest->getId(),
            'id3' => $id,
        ]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $hosts = $form->get('hosts')->getData();
            $hostsNew = $form->get('guests')->getData();
            $description = $form->get('description')->getViewData();
            $clubH = $searchIdGuest;



            $season = $this->getParameter("season.global_param");

            $searchInformationFb = $this->getDoctrine()
                ->getRepository(InformationFb::class)
                ->findBy([
                    'footballer' => $hosts[0]->getFootballer(),
                    'season' => $season]);

            $searchInformationFbNew = $this->getDoctrine()
                ->getRepository(PlayTime::class)
                ->findOneBy([
                    'footballer' => $hostsNew[0]->getFootballer(),
                    'match' => $matchs,
                    'club' => $clubH
                ]);

            $em = $this->getDoctrine()->getManager();
            $searchInformationFb[0]->setMatchs($searchInformationFb[0]->getMatchs() + 1);
            $em->persist($searchInformationFb[0]);
            $em->flush();


            if (!empty($hosts) && !empty($hostsNew)) {

                $searchPlayFb = $this->getDoctrine()
                    ->getRepository(PlayTime::class)
                    ->findOneBy([
                        'footballer' => $hosts[0]->getFootballer(),
                        'club' => $clubH,
                        'match' => $matchs
                    ]);
                $em = $this->getDoctrine()->getManager();
                $searchPlayFb->setPlay(3);
                $searchInformationFbNew->setPlay(1);
                $searchInformationFbNew->setDescription($description);
                $em->persist($searchInformationFbNew);
                $em->persist($searchPlayFb);
                $em->flush();


                return $this->redirectToRoute("app_details_match", ['id' => $id]);
            } else

                $this->addFlash("error", "Wybierz zawodników.");

        }

        return $this->render("Matchs/addSquad.html.twig", [
            'form' => $form->createView()
        ]);

    }

}