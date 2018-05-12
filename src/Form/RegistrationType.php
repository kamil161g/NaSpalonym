<?php


namespace App\Form;


use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;


class RegistrationType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder

            ->add('name',TextType::class,['label' => 'Imię:',
                'constraints'
        => new NotBlank([
                'message' => 'To pole nie może być puste.'
                ]),
                'constraints'

            => new Length([
                    'min' => 3,
                    'max' => 22,
                    'minMessage' => 'Imię nie może być krótszę niż 3 znaki.',
                    'maxMessage' => 'Imię nie może być dłuższę niż 22 znaki.'
                    ]
                )
                ])
            ->add('surname',TextType::class,['label' => 'Nazwisko:',
                'constraints'
            => new NotBlank([
                    'message' => 'To pole nie może być puste.'
                ]), 'constraints'

              =>  new Length([
                        'min' => 3,
                        'max' => 22,
                        'minMessage' => 'Nazwisko nie może być krótszę niż 3 znaki.',
                        'maxMessage' => 'Nazwisko nie może być dłuższę niż 22 znaki.'
                    ]
                )

            ])
            ->add('email',EmailType::class,[
                'constraints' => new Email(['message' => 'Podaj prawidłowo email']),
                'constraints' => new NotBlank(['message' => 'To pole nie może być puste.']),
            ])
            ->add('password', RepeatedType::class, array(
                'invalid_message' => 'Hasła nie są takie same.',
                'type' => PasswordType::class,
                'first_options'  => array('constraints'=> new NotBlank(['message' => 'Wypełnij pole Hasło.']),
                    'constraints' => new Length([
                        'min' => 8,
                        'minMessage' => 'Hasło nie może być krótsze niż 8 znaków.',
                        'max' => 24,
                        'maxMessage' => 'Haslo nie może być dłuższe niż 24 znaki.'
                    ]),
                    'label' => 'Hasło'),
                'second_options' => array(
                    'constraints'=> new NotBlank(['message' => 'Wypełnij pole Hasło.']),
                    'label' => 'Powtórz hasło'),
            ))
        ->add('termsAccepted', CheckboxType::class, [
        'mapped' => false,
        'constraints' => new IsTrue(),
        'label' => ' '
        ])

            ->add('submit',SubmitType::class,['label' => 'Zarejestruj się']  );

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            ['data_class' =>Users::class]);
    }


}