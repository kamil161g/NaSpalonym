<?php
/**
 * Created by PhpStorm.
 * User: kamil
 * Date: 16.12.17
 * Time: 23:26
 */

namespace App\Controller;


use App\Entity\Footballer;
use App\Entity\InformationFb;
use App\Form\ChooseSeasonFbType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class detailsFootballerController extends Controller
{

    public function detailsFootballerAction($footballer, Request $request, InformationFb $informationFb)
    {
        $form = $this->createForm(ChooseSeasonFbType::class, $informationFb,  ['id' => $footballer]);
            $form->handleRequest($request);

                if($form->isSubmitted()){

                    $season = $form->get('plainSeason')->getViewData();


                    $result = $this->getDoctrine()
                        ->getRepository(InformationFb::class)
                        ->detailsFootballer($footballer, $season);



                            $result2 = $this->getDoctrine()
                                ->getRepository(Footballer::class)
                                ->findUser($footballer);

                                $birthDay = $result2->getDateOfBirth();


                                    $format = date_format($birthDay, 'Y-m-d');


                                        $age = date_diff(date_create($format), date_create('today'))->y;

                    return $this->render("Footballers/details.html.twig",[
                        'result' => $result,
                        'age' => $age,
                        'form' => $form->createView(),
                        'id' => $footballer,
                    ]);

                }


            return $this->render("Footballers/details.html.twig",[
                'form' => $form->createView(),
                'id' => $footballer
            ]);


    }




}