<?php


namespace App\Controller;


use App\Entity\Matchs;
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


        return $this->render("Matchs/details.html.twig", [
            'matchs' => $details,
            'now' => $now,
            'timematch' => $timematch
        ]);
    }




}