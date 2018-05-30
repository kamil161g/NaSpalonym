<?php
/**
 * Created by PhpStorm.
 * User: kamil
 * Date: 25.01.18
 * Time: 19:05
 */

namespace App\Form;


use App\Entity\InformationFb;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class changeScoreType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $id = $options['id'];
        $id2 = $options['id2'];
        $builder
            ->add('hostName',EntityType::class,[
                'class' => 'App\Entity\InformationFb',
                'query_builder' => function (EntityRepository $er) use ($id) {
                    return $er->createQueryBuilder('u')
                        ->where('u.club = :id')
                        ->setParameter('id', $id);
                },
                'choice_label' => function (InformationFb $x) {
                    return $x->getFootballer()->getName().' '.$x->getFootballer()->getSurname();
                },
                'choice_value' => 'footballer.id',
                'placeholder' => '',
                'label' => 'Drużyna Gospodarzy:'])
            ->add('guestName',EntityType::class,[
                'class' => 'App\Entity\InformationFb',
                'query_builder' => function (EntityRepository $er) use ($id2) {
                    return $er->createQueryBuilder('u')
                        ->where('u.club = :id2')
                        ->setParameter('id2', $id2);
                },
                'choice_label' => function (InformationFb $x) {
                    return $x->getFootballer()->getName().' '.$x->getFootballer()->getSurname();
                },
                'choice_value' => 'footballer.id',
                'placeholder' => '',
                'label' => 'Drużyna Gości:'])
        ->add('goalHost',IntegerType::class, ['label' => 'Gole strzelone przez gospodarzy:'])
        ->add('goalGuest',IntegerType::class, ['label' => 'Gole strzelone przez gości:'])
        ->add('minutes',IntegerType::class,['label' => 'Minuta:'])
        ->add('submit',SubmitType::class,['label' => 'Wyślij']);

    }

    public function configureOptions(OptionsResolver $resolver) : void
    {
        $resolver->setRequired([
            'id',
            'id2',
        ]);
        $resolver->setDefaults([
            'attr' => ['novalidate' => 'novalidate']
        ]);
    }

}

