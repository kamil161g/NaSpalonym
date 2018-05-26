<?php


namespace App\Controller;


use App\Entity\InformationFb;
use App\Entity\Matchs;
use App\Entity\Shooter;
use App\Entity\Team;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
        $hostTeam = $searchTime->getHostTeam();
        $guestTeam = $searchTime->getGuestTeam();

            $hostId = $this->getDoctrine()
                ->getRepository(Team::class)
                ->findOneBy(['name' => $hostTeam]);

                $searchHosts = $this->getDoctrine()
                    ->getRepository(InformationFb::class)
                    ->findBy(['club' => $hostId->getId()]);


            $guestId = $this->getDoctrine()
                ->getRepository(Team::class)
                ->findOneBy(['name' => $guestTeam]);

                $searchGuest = $this->getDoctrine()
                    ->getRepository(InformationFb::class)
                    ->findBy(['club' => $guestId->getId()]);


        foreach ($searchHosts as $item) {
            $searchH[] = $item->getFootballer();
        }

        foreach ($searchGuest as $item) {
            $searchG[] = $item->getFootballer();
        }

        $hosts = $this->getDoctrine()
            ->getRepository(Shooter::class)
            ->findBy(['match' => $id, 'shooter' => $searchH]);

        $guests = $this->getDoctrine()
            ->getRepository(Shooter::class)
            ->findBy(['match' => $id, 'shooter' => $searchG]);



        return $this->render("Matchs/details.html.twig", [
            'matchs' => $details,
            'now' => $now,
            'timematch' => $timematch,
            'hostGoal' => $hosts,
            'guestGoal' => $guests
        ]);
    }




}