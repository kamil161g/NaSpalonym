<?php


namespace App\Form;


use App\Entity\InformationFb;
use App\Entity\InformationTeam;
use App\Entity\Team;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class AddDetailsTeamType extends AbstractType
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
            ->add('matchs', IntegerType::class, ['constraints' => new NotBlank([
                'message' => 'To pole nie może być puste.']),
                'label' => 'Ilośc meczy'])
            ->add('goalsScored', IntegerType::class, ['constraints' => new NotBlank([
                'message' => 'To pole nie może być puste.']),
                'label' => 'Gole strzelone'])
            ->add('goalsLost', IntegerType::class, ['constraints' => new NotBlank([
                'message' => 'To pole nie może być puste.']),
                'label' => 'Gole stracone'])
            ->add('points', IntegerType::class, ['constraints' => new NotBlank([
                'message' => 'To pole nie może być puste.']),
                'label' => 'Punkty'])
            ->add('wins', IntegerType::class, ['constraints' => new NotBlank([
                'message' => 'To pole nie może być puste.']),
                'label' => 'Wygrane'])
            ->add('lost', IntegerType::class, ['constraints' => new NotBlank([
                'message' => 'To pole nie może być puste.']),
                'label' => 'Przegrane'])
            ->add('draw', IntegerType::class, ['constraints' => new NotBlank([
                'message' => 'To pole nie może być puste.']),
                'label' => 'Remisy'])
            ->add('brochure', FileType::class, array('label' => 'Herb'))
            ->add('submit', SubmitType::class, ['label' => 'Prześlij']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefaults([
                'data_class' => InformationTeam::class
            ]);
    }

}