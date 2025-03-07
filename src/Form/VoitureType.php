<?php

namespace App\Form;

use App\Entity\Voiture;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use App\Enum\GearboxChoice;
use Composer\Semver\Constraint\Constraint;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class VoitureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom de la voiture',
                'required' => true,
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'required' => true,
            ])
            ->add('monthlyPrice', IntegerType::class, [
                'label' => 'Prix mensuel',
                'required' => true,
            ])
            ->add('dailyPrice', IntegerType::class, [
                'label' => 'Prix journalier',
                'required' => true,
            ])
            ->add('nbOfPlaces'  , ChoiceType::class, [
                'label' => 'Nombre de places',
                'choices' => range(1, 9, 1),
                'choice_label' => function($choice) {
                    return $choice;
                },
                'required' => true,
            ])
            ->add('gearbox', ChoiceType::class, [
                'choices' => 
                [
                    'Manuelle' => GearboxChoice::Manual,
                    'Automatique' => GearboxChoice::Automatic,
                    ],
                'label' => 'Boîte de vitesse',
                'required' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Voiture::class,
        ]);
    }
}
