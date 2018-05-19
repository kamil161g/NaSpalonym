<?php
/**
 * Created by PhpStorm.
 * User: kamil
 * Date: 15.05.18
 * Time: 08:50
 */

namespace App\Form;


use App\Entity\InformationTeam;
use App\Entity\Team;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ShowTableType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('division',ChoiceType::class,array(
                'choices'  => array(
                    'I' => 1,
                    'II' => 2,
                    'III' => 3,
                    'IV' => 4,
                ),'label' => 'Dywizja:' ))

            ->add('league',ChoiceType::class,array(
                'choices'  => array(
                    'B' => 'B',
                    'A' => 'A',
                ),'label' => 'Klasa:' ))

            ->add('season',ChoiceType::class,array(
                'choices'  => array(
                    '2017/2018' => '2017/2018',
                    '2016/2017' => '2016/2017',
                ),'label' => 'Sezon:' ))

            ->add('submit',SubmitType::class,['label' => 'Pokaż']);

    }


}