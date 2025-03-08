<?php

namespace App\Form;

use App\Entity\Voiture;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use App\Enum\GearboxChoice;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VoitureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom de la voiture',
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
            ])
            ->add('monthlyPrice', IntegerType::class, [
                'label' => 'Prix mensuel',
            ])
            ->add('dailyPrice', IntegerType::class, [
                'label' => 'Prix journalier',
            ])
            ->add('nbOfPlaces'  , ChoiceType::class, [
                'label' => 'Nombre de places',
                'choices' => range(1, 9, 1),
                'choice_label' => function($choice) {
                    return $choice;
                },
            ])
            ->add('gearbox', ChoiceType::class, [
                'choices' => 
                [
                    'Manuelle' => GearboxChoice::Manual,
                    'Automatique' => GearboxChoice::Automatic,
                    ],
                'label' => 'Boîte de vitesse',
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
