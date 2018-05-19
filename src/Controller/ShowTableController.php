<?php
/**
 * Created by PhpStorm.
 * User: kamil
 * Date: 15.05.18
 * Time: 08:44
 */

namespace App\Controller;


use App\Entity\InformationTeam;
use App\Form\ShowTableType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ShowTableController extends Controller
{

    public function showTableAction(Request $request)
    {
        $form = $this->createForm(ShowTableType::class);

         $form->handleRequest($request);

             if($form->isSubmitted()){

                 $season = $form->get('season')->getViewData();
                 $league = $form->get('league')->getViewData();
                 $division = $form->get('division')->getViewData();


                     $clubs = $this->getDoctrine()
                         ->getRepository(InformationTeam::class)
                         ->showTable($season, $league, $division);



                 return $this->render("Tables/showTable.html.twig",[
                     'form' => $form->createView(),
                     'club' => $clubs,
                 ]);
             }


        return $this->render("Tables/showTable.html.twig",[
            'form' => $form->createView()
        ]);
    }

}