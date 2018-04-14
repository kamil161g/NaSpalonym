<?php
/**
 * Created by PhpStorm.
 * User: kamil
 * Date: 23.01.18
 * Time: 17:38
 */

namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class howAddType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id',NumberType::class)
            ->add('id_club',NumberType::class)
            ->add('submit',SubmitType::class);
    }


}