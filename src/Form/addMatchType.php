<?php

namespace App\Form;


use App\Entity\Matchs;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class addMatchType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('hostTeam',ChoiceType::class,array(
                'choices'  => array(
                    'LKS Czeluśnica' => 'LKS Czeluśnica',
                    'Umieszcz' => 'Umieszcz',
                ),'label' => 'Gospodzarz:' ))

            ->add('guestTeam',ChoiceType::class,array(
                'choices'  => array(
                    'LKS Czeluśnica' => 'LKS Czeluśnica',
                    'Umieszcz' => 'Umieszcz',
                ),'label' => 'Gość:' ))
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
            ->add('goalHost',HiddenType::class,['data'=> 0])
            ->add('goalGuest',HiddenType::class,['data'=> 0])
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



