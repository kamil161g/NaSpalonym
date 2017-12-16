<?php


namespace App\Form;


use App\Entity\Footballer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class addDetailsFootballerType extends AbstractType
{
        public function buildForm(FormBuilderInterface $builder, array $options)
        {
            $builder
                ->add('name', TextType::class,[
                    'constraints' => new NotBlank([
                        'message' => 'To pole nie może być puste.'
                    ]),
                    'constraints' => new Length([
                    'min'        => 3,
                    'minMessage' => 'Imię musi zawierać minimum 3 znaki.',
                    'max'        => 24,
                    'maxMessage' => 'Imię może zawierać maksymalnie 24 znaki.'
                    ]),
                    'label' => 'Imię:'
                ])

                ->add('surname', TextType::class,[
                    'constraints' => new NotBlank([
                        'message' => 'To pole nie może być puste.'
                    ]),
                    'constraints' => new Length([
                        'min'        => 3,
                        'minMessage' => 'Nazwisko musi zawierać minimum 3 znaki.',
                        'max'        => 24,
                        'maxMessage' => 'Nazwisko może zawierać maksymalnie 24 znaki.'
                    ]),
                    'label' => 'Nazwisko:'
                ])

                ->add('dateOfBirth', BirthdayType::class,[
                    'label' => 'Data urodzenia:'
                ])

                ->add('club', TextType::class,[
                        'constraints' => new NotBlank([
                            'message' => 'To pole nie może być puste.'
                        ]),
                    'constraints' => new Length([
                            'min'        => 3,
                            'minMessage' => 'Klub musi zawierać minimum 3 znaki.',
                            'max'        => 24,
                            'maxMessage' => 'Klub może zawierać maksymalnie 24 znaki.'
                        ]),
                    'label' => 'Klub:'
                ])
                ->add('submit',SubmitType::class, ['label' => 'Dodaj']);


        }

        public function configureOptions(OptionsResolver $resolver)
        {
            $resolver
                ->setDefaults([
                    'data_class' => Footballer::class
                ]);
        }
}