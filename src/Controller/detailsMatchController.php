<?php


namespace App\Controller;


use App\Entity\Footballer;
use App\Entity\InformationTeam;
use App\Entity\Matchs;
use App\Entity\Shooter;
use App\Entity\Team;
use App\Form\changeScoreType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class detailsMatchController extends Controller
{

    public function showDetailsAction($id, Matchs $matchs)
    {

        $now = new \DateTime('now');

            $details = $this->getDoctrine()
                ->getRepository(Matchs::class)
                ->showDetails($id);

                $searchTime = $this->getDoctrine()
                    ->getRepository(Matchs::class)
                    ->findOneBy(['id' => $id]);


        $timematch = $searchTime->getStartMatch()->format('Y-m-d H:i:s');
        $endmatch = $searchTime->getEndMatch()->format('Y-m-d H:i:s');


        return $this->render("Matchs/details.html.twig", [
            'matchs' => $details,
            'now' => $now,
            'timematch' => $timematch
        ]);
    }
    //     * @ParamConverter("team", class="App:Team", options={"id" = "team_id"})


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

                                    $em = $this->getDoctrine()->getManager();

                                        $this->getDoctrine()->getRepository(Shooter::class)
                                            ->addShooter($findFb,$matchs,$minutes,$shooter);

                                        $this->getDoctrine()->getRepository(Matchs::class)
                                            ->addGoals($matchs, $goalHost, $goalGuest);


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