<?php
/**
 * Created by PhpStorm.
 * User: kamil
 * Date: 16.12.17
 * Time: 10:51
 */

namespace App\Controller;


use App\Entity\Matchs;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class liveController extends Controller
{

    public function showLiveAction()
    {

        $now = new \DateTime('now');

            $live = $this->getDoctrine()
            ->getRepository(Matchs::class)
            ->findLiveMatchs($now, $now);



        return $this->render("Live/index.html.twig",['live' => $live]);
    }

}