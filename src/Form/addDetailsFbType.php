<?php


namespace App\Form;


use App\Entity\InformationFb;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class addDetailsFbType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('season',ChoiceType::class,array(
                'choices'  => array(
                    '2017/2018' => '2017/2018',
                    '2016/2017' => '2016/2017',
                    '2015/2016' => '2015/2016',
                    '2014/2015' => '2014/2015',
                    '2013/2014' => '2013/2014',
                    '2012/2013' => '2012/2013',
                ),'label' => 'Sezon:' ))
            ->add('goals', TextType::class, ['constraints' => new NotBlank([
                'message' => 'To pole nie może być puste.']),
                'label' => 'Gole'])
            ->add('matchs', TextType::class, ['constraints' => new NotBlank([
                'message' => 'To pole nie może być puste.']),
                'label' => 'Mecze'])
            ->add('position',ChoiceType::class,array(
                'choices'  => array(
                    'Bramkarz' => 'Bramkarz',
                    'Obrońca' => 'Obrońca',
                    'Pomocnik' => 'Pomocnik',
                    'Napastnik' => 'Napastnik',
                ),'label' => 'Pozycja:' ))
            ->add('submit', SubmitType::class, ['label' => 'Prześlij']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefaults([
                'data_class' => InformationFb::class
            ]);
    }

}