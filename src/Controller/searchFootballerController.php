<?php
/**
 * Created by PhpStorm.
 * User: kamil
 * Date: 16.12.17
 * Time: 20:26
 */

namespace App\Controller;


use App\Entity\Footballer;
use App\Form\searchFootballerType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class searchFootballerController extends Controller
{

    public function searchFootballerAction(Request $request)
    {
            $form = $this->createForm(searchFootballerType::class);

            $form->handleRequest($request);

        $lastAdd = $this->getDoctrine()
            ->getRepository(Footballer::class)
            ->lastAdd();

            if($form->isSubmitted()){

                $name = addcslashes($name = $form->get('name')->getData(), "%_");
                $surname = addcslashes($form->get('surname')->getData(), "%_");

                $result = $this->getDoctrine()
                    ->getRepository(Footballer::class)
                    ->searchFootballer($name, $surname);



                return $this->render("Footballers/searchFootballer.html.twig",[
                    'form' => $form->createView(),
                    'result' => $result,
                    'lastAdd' => $lastAdd
                ]);

            }

        return $this->render("Footballers/searchFootballer.html.twig",[
            'form' => $form->createView(),
            'lastAdd' => $lastAdd
        ]);
    }

}