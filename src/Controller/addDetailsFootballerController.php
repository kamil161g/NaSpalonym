<?php


namespace App\Controller;


use App\Entity\Footballer;
use App\Entity\InformationFb;
use App\Entity\Team;
use App\Form\addDetailsFbType;
use App\Form\howAddType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class addDetailsFootballerController extends Controller
{


    public function howAddAction(Request $request)
    {
        $form = $this->createForm(howAddType::class);

        $form->handleRequest($request);

        if($form->isSubmitted()) {

            $id = $form->get('id')->getData();
            $id_club = $form->get('id_club')->getData();

            return $this->redirectToRoute("add_details_fb",[
                "id" => $id,
                "team_id" => $id_club
            ]);
        }

        return $this->render("Footballers/howAdd.html.twig",[
            "form" => $form->createView()
        ]);

    }


    /**
     * @Route("/add/footballer/{id}/{team_id}", name="add_details_fb")
     * @ParamConverter("team", class="App:Team", options={"id" = "team_id"})
     */
    public function addDetailsAction(Request $request, Footballer $footballer, Team $team)
    {

        $informationFb = new InformationFb();

         $form = $this->createForm(addDetailsFbType::class, $informationFb);

            $form->handleRequest($request);

                if($form->isSubmitted()){

                        $em = $this->getDoctrine()->getManager();
                        $informationFb->setFootballer($footballer);
                        $informationFb->setClub($team);
                        $em->persist($informationFb);
                        $em->flush();

                    return $this->redirectToRoute('app_how_ad_fb');

                }

        return $this->render("Footballers/addDetails.html.twig",[
            'form' => $form->createView()
        ]);
    }


}