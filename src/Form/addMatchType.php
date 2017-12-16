<?php
/**
 * Created by PhpStorm.
 * User: kamil
 * Date: 12.12.17
 * Time: 11:49
 */

namespace App\Form;


use App\Entity\Match;
use App\Entity\Matchs;
use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class addMatchType extends AbstractType
{
        public function buildForm(FormBuilderInterface $builder, array $options)
        {
            $builder
            ->add('hostTeam', TextType::class,['label' => 'Gospodarze:'])
                ->add('guestTeam', TextType::class,['label' => 'Goście:'])
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
                ->add('startMatch', DateTimeType::class, ["data" => new \DateTime('today'),'label' => 'Data rozpoczęcia::'])
                ->add('submit', SubmitType::class, ['label' => 'Dodaj']);
        }

        public function configureOptions(OptionsResolver $resolver)
        {
            $resolver->setDefaults([
                'data_class' => Matchs::class,
            ]);
        }
}