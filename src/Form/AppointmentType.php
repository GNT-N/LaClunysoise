<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class AppointmentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Civilite', ChoiceType::class, [
                'choices' => [
                    'M.' => 'Monsieur',
                    'Mme' => 'Madame',
                ],
                'attr' => ['class' => 'form-control mt-4'],
                'label' => ' ',
            ])
            ->add('Nom', TextType::class, [
                'attr' => ['class' => 'form-control mt-4', 'placeholder' => 'Nom'],
                'label' => ' ',
            ])
            ->add('Prenom', TextType::class, [
                'attr' => ['class' => 'form-control mt-4', 'placeholder' => 'Prenom'],
                'label' => ' ',
            ])
            ->add('Telephone', TextType::class, [
                'attr' => ['class' => 'form-control mt-4', 'placeholder' => 'Téléphone'],
                'label' => ' ',
            ])
            ->add('email', EmailType::class, [
                'attr' => ['class' => 'form-control mt-4', 'placeholder' => 'email'],
                'label' => ' ',
            ])
            ->add('Adresse', TextareaType::class, [
                'attr' => ['class' => 'form-control mt-4', 'placeholder' => 'Adresse'],
                'label' => ' ',
            ])
            ->add('ModeTransport', ChoiceType::class, [
                'choices' => [
                    'Assis' => 'assis',
                    'Allongé' => 'allongé',
                ],
                'attr' => ['class' => 'form-control mt-4'],
                'label' => 'Mode de transport (assis / allongé)',
            ])
            ->add('LieuxRendezVous', TextareaType::class, [
                'attr' => ['class' => 'form-control mt-4', 'placeholder' => 'Lieux du rendez-vous'],
                'label' => ' ',
            ])
            ->add('TypeEtablissement', ChoiceType::class, [
                'choices' => [
                    'Hopital' => 'Hôpital',
                    'MedecinGen' => 'Medecin Généraliste',
                    'MedecinSpe' => 'Medecin Spécialiste',
                    'Kine' => 'Kinésithérapeute',
                    'Autre' => 'Autre',
                ],
                'attr' => ['class' => 'form-control mt-4'],
                'label' => 'Type d\'établissement',
            ])
            ->add('DateRendezVous', DateType::class, [
                'attr' => ['class' => 'form-control mt-4', 'placeholder' => 'Date du rendez-vous'],
                'label' => ' ',
            ])
            ->add('HeureRendezVous', TextType::class, [
                'attr' => ['class' => 'form-control mt-4', 'placeholder' => 'Heure du rendez-vous'],
                'label' => ' ',
            ])
            ->add('Aller', ChoiceType::class, [
                'choices' => [
                    'Aller simple' => 'aller_simple',
                    'Aller-retour' => 'aller_retour',
                ],
                'attr' => ['class' => 'form-control mt-4'],
                'label' => ' ',
            ])
            ->add('DureeEstimee', TextType::class, [
                'attr' => ['class' => 'form-control mt-4', 'placeholder' => 'Durée estimée du rendez-vous'],
                'label' => ' ',
            ])
            ->add('content', TextareaType::class, [
                'attr' => ['class' => 'form-control mt-4', 'placeholder' => 'Commentaires éventuels'],
                'label' => ' ',
            ])
            ->add('envoyer', SubmitType::class, [
                'attr' => ['class' => 'form-control mt-4'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
