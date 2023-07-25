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
                'expanded' => true,
                'label' => ' ',
                'label_html' => true, // Permet d'utiliser des balises HTML dans le label
                'choice_attr' => function ($choice, $key, $value) {
                    return ['label' => strip_tags($choice, '<i>')];
                },
            ])
            ->add('Nom', TextType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Nom *'],
                'label' => ' ',
            ])
            ->add('Prenom', TextType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Prenom *'],
                'label' => ' ',
            ])
            ->add('Telephone', TextType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Téléphone *'],
                'label' => ' ',
            ])
            ->add('email', EmailType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'email *'],
                'label' => ' ',
            ])
            ->add('Rue', TextType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Rue *'],
                'label' => ' ',
            ])
            ->add('Ville', TextType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Ville *'],
                'label' => ' ',
            ])
            ->add('Postcode', TextType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Code Postale *'],
                'label' => ' ',
            ])


            // ---------- Rendez-vous ----------
            ->add('DateRendezVous', DateType::class, [
                'attr' => ['class' => 'form-control','placeholder' => 'Date du rendez-vous'],
                'input'  => 'datetime_immutable',
                'widget' => 'single_text',
                'label' => 'Date du rendez-vous *',
            ])
            ->add('HeureRendezVous', TimeType::class, [
                'attr' => ['class' => 'form-control','placeholder' => 'Heure du rendez-vous',],
                'input'  => 'datetime',
                'widget' => 'single_text',
                'label' => 'Heure du rendez-vous *',
            ])
            ->add('DureeEstimee', TimeType::class, [
                'attr' => ['class' => 'form-control','placeholder' => 'Durée estimée du rendez-vous'],
                'input'  => 'datetime',
                'widget' => 'single_text',
                'label' => 'Durée estimée',
                'required' => false,
                'empty_data' => '00:00',
            ])

            ->add('LieuxRendezVous', TextType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Lieux du rendez-vous *'],
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
            ->add('Prescripteur', TextType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Médecin prescripteur'],
                'label' => ' ',
                'required' => false,
            ])
                ->add('Motif', ChoiceType::class, [
                    'choices' => [
                        'Consultation' => 'Consultation',
                'Examen' => 'Examen',
                'Hôspitalisation' => 'Hôspitalisation',
                'Hôspitalisation de jour' => 'Hôspitalisation de jour',
                'Autre' => 'Autre',
                ],
                'attr' => ['class' => 'form-control'],
                'label' => ' ',
            ])

            ->add('ModeTransport', ChoiceType::class, [
                'choices' => [
                    '<i class="fas fa-chair"></i> Assis' => 'assis',
                    '<i class="fas fa-bed"></i> Allongé' => 'allongé',
                ],
                'expanded' => true,
                'label' => ' ',
                'label_html' => true,
                'choice_attr' => function ($choice, $key, $value) {
                    return ['label' => strip_tags($choice, '<i>')];
                },
            ])
            ->add('Aller', ChoiceType::class, [
                'choices' => [
                    '<i class="fas fa-plane"></i> Aller simple' => 'aller_simple',
                    '<i class="fas fa-exchange-alt"></i> Aller-retour' => 'aller_retour',
                ],
                'expanded' => true,
                'label' => ' ',
                'label_html' => true,
                'choice_attr' => function ($choice, $key, $value) {
                    return ['label' => strip_tags($choice, '<i>')];
                },
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
