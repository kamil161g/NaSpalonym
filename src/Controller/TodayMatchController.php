<?php
/**
 * Created by PhpStorm.
 * User: kamil
 * Date: 11.06.18
 * Time: 14:29
 */

namespace App\Controller;


use App\Entity\Matchs;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class TodayMatchController extends Controller
{

    public function showMatchsAction(Request $request)
    {

        $form = $this->createFormBuilder()
            ->add('today', DateType::class, ["data" => new \DateTime('today'),'label' => 'Wybierz datę:'])
            ->add('submit', SubmitType::class, ['label' => 'Pokaż'])
            ->getForm();

            $form->handleRequest($request);

            if($form->isSubmitted()){

                $czas = $form->get('today')->getData()->format("Y-m-d")." 00:00:00";
                $czass = $form->get('today')->getData();
                $maxCzas = $czass->modify('+1day')->format("Y-m-d")." 00:00:00";


                $searchMatchs = $this->getDoctrine()
                    ->getRepository(Matchs::class)
                    ->findMatchs($czas, $maxCzas);


                return $this->render('matchs.html.twig',[
                    'form' => $form->createView(),
                    'match' => $searchMatchs,

                ]);
            }



        return $this->render('matchs.html.twig',[
            'form' => $form->createView(),
        ]);
    }

}