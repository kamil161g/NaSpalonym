<?php


namespace App\Form;


use App\Entity\InformationFb;
use App\Entity\PlayTime;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChangeFbType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('hosts',EntityType::class,[
                'expanded' => true,
                'multiple' => true,
                'label' => 'Schodzi:',
                'class' => 'App\Entity\PlayTime',
                'query_builder' => function (EntityRepository $er) use ($options) {
                    return $er->createQueryBuilder('u')
                        ->innerJoin('u.footballer','a')
                        ->andWhere('u.club = :id')
                        ->andWhere('u.match = :match')
                        ->andWhere('u.play = 1')
                        ->setParameter('id', $options['id'])
                        ->setParameter('match', $options['id3']);
                },
                'choice_label' => function (PlayTime $x) {
                    return $x->getFootballer()->getName().' '.$x->getFootballer()->getSurname();
                },])
            ->add('guests',EntityType::class,[
                'expanded' => true,
                'multiple' => true,
                'label' => 'Wchodzi:',
                'class' => 'App\Entity\PlayTime',
                'query_builder' => function (EntityRepository $er) use ($options) {
                    return $er->createQueryBuilder('u')
                        ->innerJoin('u.footballer','a')
                        ->andWhere('u.club = :id')
                        ->andWhere('u.match = :match')
                        ->andWhere('u.play = 0')
                        ->setParameter('id', $options['id'])
                        ->setParameter('match', $options['id3']);
                },
                'choice_label' => function (PlayTime $x) {
                    return $x->getFootballer()->getName().' '.$x->getFootballer()->getSurname();
                },])
            ->add('description', TextareaType::class, ['label' => 'Opis:'])
            ->add('submit',SubmitType::class,['label' => 'Zmień']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {

        $resolver
            ->setDefaults([
                'id' => null,
                'id2' => null,
                'id3' => null,
                'attr'=>array('novalidate'=>'novalidate')
            ]);
    }

}