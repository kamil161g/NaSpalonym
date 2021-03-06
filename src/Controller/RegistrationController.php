<?php


namespace App\Controller;


use App\Entity\Users;
use App\Form\RegistrationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class RegistrationController extends Controller
{

    public function addNewUserAction(Request $request, UserPasswordEncoderInterface $passwordEncoder, \Swift_Mailer $mailer)
    {
        $users = new Users();
        $form = $this->createForm(RegistrationType::class, $users);

            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid() && $this->captchaverify($request->get('g-recaptcha-response'))) {

                $password = $passwordEncoder->encodePassword($users, $users->getPlainPassword());

                $email = $form->get('email')->getViewData();
                $name = $form->get('name')->getViewData();
                $activate_key = md5(uniqid($email, true));

                $message = (new \Swift_Message('Witamy nowego pasjonata :)'))
                    ->setFrom('kamilgasior07test@gmail.com')
                    ->setTo($email)
                    ->setBody(
                        $this->renderView(
                            'Registration/email.html.twig',
                            array(
                                'name' => $name,
                                'activatekey' => $activate_key)
                        ),
                        'text/html'
                    );

                $mailer->send($message);

                $addUser = $this->getDoctrine()
                    ->getRepository(Users::class)
                    ->addUser($users, $password, $activate_key);


                return $this->redirectToRoute("app_index");
            }

                if($form->isSubmitted() &&  $form->isValid() && !$this->captchaverify($request->get('g-recaptcha-response'))){

                    $this->addFlash(
                        'error',
                        'Potwierdź, że nie jesteś robotem.'
                    );
                }


        return $this->render('Registration/registration.html.twig',[
            'form' => $form->createView()]);
    }

    public function captchaverify($get)
    {
        $url = "https://www.google.com/recaptcha/api/siteverify";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, array(
            "secret"=>"6Le_1FgUAAAAAA8_YTFjczBzxgHJG5RbW9ohiRqe","response"=>$get));
        $response = curl_exec($ch);
        curl_close($ch);
        $data = json_decode($response);

        return $data->success;
    }


//    public function infoRegistrationAction()
//    {
//
//        return $this->render("Registration/info.html.twig");
//    }


    public function successRegistrationAction($activatekey)
    {

        $searchKey = $this->getDoctrine()
            ->getRepository(Users::class)
            ->findOneBy(['activatekey' => $activatekey]);

        $this->getDoctrine()
            ->getRepository(Users::class)
            ->changeActive($searchKey);


        return $this->render("Registration/success.html.twig");
    }


}