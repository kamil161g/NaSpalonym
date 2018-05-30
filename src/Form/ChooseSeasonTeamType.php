<?php
/**
 * Created by PhpStorm.
 * User: kamil
 * Date: 28.05.18
 * Time: 12:43
 */

namespace App\Form;


use App\Entity\InformationTeam;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChooseSeasonTeamType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('plainSeason', EntityType::class, [
                'class' => 'App\Entity\InformationTeam',
                'choice_label' => 'season',
                'choice_value' => 'season',
                'label' => 'Wybierz Sezon:',
                'query_builder' => function (EntityRepository $er) use ($options) {
                    return $er->createQueryBuilder('p')
                        ->andWhere('p.team = :team')
                        ->setParameter('team', $options['team']);
                }
            ])
            ->add('submit',SubmitType::class,['label' => "Pokaż"]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => InformationTeam::class,
            'team' => null,
        ]);
    }

}