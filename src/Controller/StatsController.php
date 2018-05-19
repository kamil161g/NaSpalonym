<?php


namespace App\Controller;


use App\Entity\InformationFb;
use App\Entity\Shooter;
use App\Form\StatsType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class StatsController extends Controller
{

    public function showStatsAction(Request $request)
    {
        $form = $this->createForm(StatsType::class);

        $form->handleRequest($request);

            if($form->isSubmitted()){

                    $season = $form->get('season')->getViewData();
                    $division = $form->get('division')->getViewData();
                    $league = $form->get('league')->getViewData();



                    $result = $this->getDoctrine()
                        ->getRepository(Shooter::class)
                        ->showStats($season);


                foreach ($result as $item) {

                    $info = $this->getDoctrine()
                        ->getRepository(InformationFb::class)
                        ->searchFootballer($item['season'], $division, $league);


                    }

                return $this->render("Stats/index.html.twig",[
                    'form' => $form->createView(),
                    'result' => $result,
                    'info' => $info,
                    'season' => $season,
                ]);


            }

        return $this->render("Stats/index.html.twig",[
            'form' => $form->createView(),
        ]);

    }

}