<?php


namespace App\Controller;


use App\Entity\Users;
use App\Form\RegistrationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class RegistrationController extends Controller
{

    public function addNewUserAction(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $users = new Users();
        $form = $this->createForm(RegistrationType::class, $users);

            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){

                $password = $passwordEncoder->encodePassword($users , $users->getPlainPassword());


                $addUser = $this->getDoctrine()
                        ->getRepository(Users::class)
                        ->addUser($users, $password);

                    return $this->redirectToRoute('app_index');
            }

        return $this->render('Registration/registration.html.twig',[
            'form' => $form->createView()]);
    }


}