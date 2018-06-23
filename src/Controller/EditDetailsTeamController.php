<?php
/**
 * Created by PhpStorm.
 * User: kamil
 * Date: 27.05.18
 * Time: 12:51
 */

namespace App\Controller;


use App\Entity\InformationTeam;
use App\Entity\Team;
use App\Form\AddDetailsTeamType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class EditDetailsTeamController extends Controller
{

    public function editDetailsAction(Team $team, Request $request)
    {

        $informationTeam = new InformationTeam();


        $form = $this->createForm(AddDetailsTeamType::class, $informationTeam);

        $form->handleRequest($request);

        if($form->isSubmitted()){

            $file = $informationTeam->getBrochure();

            if(!empty($file)){

                $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();


                $file->move(
                    $this->getParameter('herbs'),
                    $fileName
                );


                $informationTeam->setBrochure($fileName);

            }

            $season = $form->get('season')->getViewData();
            $seasonDefault = 'Nie podano informajci';



            $searchTeam = $this->getDoctrine()
                ->getRepository(InformationTeam::class)
                ->searchClub($team, $season);

            $searchTeamDefault = $this->getDoctrine()
                ->getRepository(InformationTeam::class)
                ->searchClubDefault($team, $seasonDefault);


            if(!empty($searchTeam)) {

                $em = $this->getDoctrine()->getManager();
                $em->remove($searchTeam);

                $this->addFlash('error','Edytowałeś sezon: '.$season);

            }

            if(!empty($searchTeamDefault)){
                $em = $this->getDoctrine()->getManager();
                $em->remove($searchTeamDefault);
            }

            $this->getDoctrine()
                ->getRepository(InformationTeam::class)
                ->addDetailsTeam($informationTeam,$team);

            return $this->redirectToRoute("app_details_team",['team' => $team->getId()]);

        }


        return $this->render('Teams/addDetails.html.twig',[
            'form' => $form->createView(),
        ]);
    }

    /**
     * @return string
     */
    private function generateUniqueFileName()
    {

        return md5(uniqid());
    }




}