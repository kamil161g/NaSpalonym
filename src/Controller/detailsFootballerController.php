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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class detailsFootballerController extends Controller
{

    public function detailsFootballerAction($id)
    {

        $result = $this->getDoctrine()
            ->getRepository(InformationFb::class)
            ->detailsFootballer($id);


        $result2 = $this->getDoctrine()
            ->getRepository(Footballer::class)
            ->findUser($id);

            $birthDay = $result2->getDateOfBirth();


            $format = date_format($birthDay, 'Y-m-d');


            $age = date_diff(date_create($format), date_create('today'))->y;


        return $this->render("Footballers/details.html.twig",[
            'result' => $result,
            'age' => $age
        ]);
    }

}