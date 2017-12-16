<?php
/**
 * Created by PhpStorm.
 * User: kamil
 * Date: 14.12.17
 * Time: 11:29
 */

namespace App\Form;


use App\Entity\Matchs;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class searchMatchsType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('division',ChoiceType::class,array(
                'choices'  => array(
                    'I' => 1,
                    'II' => 2,
                    'III' => 3,
                ), 'label' => 'Dywizja'))
            ->add('league',ChoiceType::class,array(
                'choices'  => array(
                    'B' => 'B',
                    'A' => 'A',
                ),'label' => 'Klasa' ))
            ->add('submit', SubmitType::class, ['label' => 'Wyszukaj']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Matchs::class,
        ]);
    }

}