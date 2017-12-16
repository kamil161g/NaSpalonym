<?php
/**
 * Created by PhpStorm.
 * User: kamil
 * Date: 16.12.17
 * Time: 10:26
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class indexController extends Controller
{

    public function showIndexAction()
    {

        return $this->render('index.html.twig');
    }

}