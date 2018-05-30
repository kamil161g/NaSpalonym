<?php
/**
 * Created by PhpStorm.
 * User: kamil
 * Date: 27.05.18
 * Time: 14:52
 */

namespace App\Form;


use App\Entity\Team;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class AddTeamType extends AbstractType
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
                        'minMessage' => 'Nazwa drużyny musi zawierać minimum 3 znaki.',
                        'max'        => 24,
                        'maxMessage' => 'Nazwa drużyny może zawierać maksymalnie 24 znaki.'
                    ]),
                    'label' => 'Nazwa drużyny:'
                ])
                ->add('division',ChoiceType::class,array(
                    'choices'  => array(
                        'I' => 1,
                        'II' => 2,
                        'III' => 3,
                    ),'label' => 'Dywizja:' ))
                ->add('league',ChoiceType::class,array(
                    'choices'  => array(
                        'B' => 'B',
                        'A' => 'A',
                    ),'label' => 'Klasa:' ))
                ->add('submit', SubmitType::class, ['label' => 'Dodaj']);

        }

        public function configureOptions(OptionsResolver $resolver)
        {
            $resolver
                ->setDefaults([
                    'data_class' => Team::class
                ]);

        }


}