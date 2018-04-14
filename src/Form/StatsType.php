<?php
/**
 * Created by PhpStorm.
 * User: kamil
 * Date: 07.02.18
 * Time: 17:39
 */

namespace App\Form;


use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StatsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('season',EntityType::class,[
                'class' => 'App\Entity\Shooter',
                'choice_label' => 'season',
                'label' => 'Wybierz Sezon:',
                'choice_value' => 'season'
            ])
            ->add('submit', SubmitType::class,['label' => 'Pokaż']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'App\Entity\Shooter'
        ]);

    }

}