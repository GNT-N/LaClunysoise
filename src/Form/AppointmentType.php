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
use Symfony\Component\Form\Extension\Core\Type\TimeType;

class AppointmentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ---------- Identité ----------
            ->add('Civilite', ChoiceType::class, [
                'choices' => [
                    'M.' => 'Monsieur',
                    'Mme' => 'Madame',
                ],
                'attr' => ['class' => 'form-control'],
                'label' => ' ',
            ])
            ->add('Nom', TextType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Nom'],
                'label' => ' ',
            ])
            ->add('Prenom', TextType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Prenom'],
                'label' => ' ',
            ])
            ->add('Telephone', TextType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Téléphone'],
                'label' => ' ',
            ])
            ->add('email', EmailType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'email'],
                'label' => ' ',
            ])
            ->add('Rue', TextType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Rue'],
                'label' => ' ',
            ])
            ->add('Ville', TextType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Ville'],
                'label' => ' ',
            ])
            ->add('Postcode', TextType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Code Postale'],
                'label' => ' ',
            ])

            // ---------- Rendez-vous ----------
            ->add('ModeTransport', ChoiceType::class, [
                'choices' => [
                    'Assis' => 'assis',
                    'Allongé' => 'allongé',
                ],
                'attr' => ['class' => 'form-control'],
                'label' => ' ',
            ])
            ->add('LieuxRendezVous', TextareaType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Lieux du rendez-vous'],
                'label' => ' ',
            ])
            ->add('TypeEtablissement', ChoiceType::class, [
                'choices' => [
                    'Hopital' => 'Hôpital',
                    'Medecin Généraliste' => 'Medecin Généraliste',
                    'Medecin Spécialiste' => 'Medecin Spécialiste',
                    'Autre' => 'Autre',
                ],
                'attr' => ['class' => 'form-control'],
                'label' => ' ',
            ])
            ->add('DateRendezVous', DateType::class, [
                'attr' => ['class' => 'form-control','placeholder' => 'Date du rendez-vous'],
                'input'  => 'datetime_immutable',
                'widget' => 'single_text',
                'label' => ' ',
            ])
            ->add('HeureRendezVous', TimeType::class, [
                'attr' => ['class' => 'form-control','placeholder' => 'Heure du rendez-vous'],
                'input'  => 'datetime',
                'widget' => 'single_text',
                'label' => ' ',
            ])
            ->add('Aller', ChoiceType::class, [
                'choices' => [
                    'Aller simple' => 'aller_simple',
                    'Aller-retour' => 'aller_retour',
                ],
                'attr' => ['class' => 'form-control'],
                'label' => ' ',
            ])
            ->add('DureeEstimee', TimeType::class, [
                'attr' => ['class' => 'form-control','placeholder' => 'Durée estimée du rendez-vous'],
                'input'  => 'datetime',
                'widget' => 'single_text',
                'label' => ' ',
                'required' => false,
                'empty_data' => '00:00',
            ])
            ->add('content', TextareaType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Commentaires éventuels'],
                'required' => false,
                'label' => ' ',
            ])
            ->add('envoyer', SubmitType::class, [
                'attr' => ['class' => 'form-control'],
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
