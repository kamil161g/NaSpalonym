<?php


namespace App\Controller;


use App\Entity\Matchs;
use App\Form\searchMatchsType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class showMatchsController extends Controller
{

    public function showMatchAction(Request $request)
    {

        $form = $this->createForm(searchMatchsType::class);

         $form->handleRequest($request);

                if($form->isSubmitted()) {


                    $now = new \DateTime('now');

                    $matchs = $this->getDoctrine()
                        ->getRepository(Matchs::class)
                        ->findAllGreaterThanStart($now, $form->get('division')->getData());


                    return $this->render("Matchs/show.html.twig", [
                        'matchs' => $matchs,
                        'form' => $form->createView(),
                    ]);
                }

        return $this->render("Matchs/show.html.twig",['form' => $form->createView()]);

    }


}