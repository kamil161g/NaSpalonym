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

class AddSquadType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('hosts',EntityType::class,[
                'expanded' => true,
                'multiple' => true,
                'label' => 'Gospodarze',
                'class' => 'App\Entity\InformationFb',
                'query_builder' => function (EntityRepository $er) use ($options) {
                    return $er->createQueryBuilder('u')
                        ->where('u.club = :id')
                        ->setParameter('id', $options['id']);
                },
                'choice_label' => function (InformationFb $x) {
                    return $x->getFootballer()->getName().' '.$x->getFootballer()->getSurname();
                },])
            ->add('guests',EntityType::class,[
                'expanded' => true,
                'multiple' => true,
                'label' => 'Goście',
                'class' => 'App\Entity\InformationFb',
                'query_builder' => function (EntityRepository $er) use ($options) {
                    return $er->createQueryBuilder('u')
                        ->where('u.club = :id')
                        ->setParameter('id', $options['id2']);
                },
                'choice_label' => function (InformationFb $x) {
                    return $x->getFootballer()->getName().' '.$x->getFootballer()->getSurname();
                },])
            ->add('description', TextareaType::class, ['label' => 'Opis:'])
            ->add('submit',SubmitType::class,['label' => 'Dodaj']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {

        $resolver
            ->setDefaults([
                'id' => null,
                'id2' => null,
            ]);
    }

}