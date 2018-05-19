<?php
/**
 * Created by PhpStorm.
 * User: kamil
 * Date: 18.05.18
 * Time: 13:16
 */

namespace App\Form;


use App\Entity\InformationFb;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChooseSeasonFbType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('plainSeason', EntityType::class, [
                'class' => 'App\Entity\InformationFb',
                'choice_label' => 'season',
                'choice_value' => 'season',
                'label' => 'Wybierz Sezon:',
                'query_builder' => function (EntityRepository $er) use ($options) {
                    return $er->createQueryBuilder('p')
                        ->andWhere('p.footballer = :id')
                        ->setParameter('id', $options['id']);
                }
                ])
        ->add('submit',SubmitType::class,['label' => "Pokaż"]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => InformationFb::class,
            'id' => null,
        ]);
    }

}