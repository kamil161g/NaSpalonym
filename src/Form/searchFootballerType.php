<?php
/**
 * Created by PhpStorm.
 * User: kamil
 * Date: 16.12.17
 * Time: 20:27
 */

namespace App\Form;


use App\Entity\Footballer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class searchFootballerType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class,['label' => 'Imię:',
                'empty_data' => 'Podaj informacje'])
            ->add('surname',TextType::class,['label' => 'Nazwisko:',
                'empty_data' => 'Podaj informacje'])
            ->add('submit',SubmitType::class,['label' => 'Szukaj']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Footballer::class
        ]);
    }

}