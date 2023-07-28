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
            ])
            ->add('Nom', TextType::class, [
                'attr' => ['class' => 'form-control border-black', 'placeholder' => 'Nom *'],
                'label' => ' ',
            ])
            ->add('Prenom', TextType::class, [
                'attr' => ['class' => 'form-control border-black', 'placeholder' => 'Prénom *'],
                'label' => ' ',
            ])
            ->add('Telephone', TextType::class, [
                'attr' => ['class' => 'form-control border-black', 'placeholder' => 'Téléphone *'],
                'label' => ' ',
            ])
            ->add('email', EmailType::class, [
                'attr' => ['class' => 'form-control border-black', 'placeholder' => 'email *'],
                'label' => ' ',
            ])
            ->add('Rue', TextType::class, [
                'attr' => ['class' => 'form-control border-black', 'placeholder' => 'Rue *'],
                'label' => ' ',
            ])
            ->add('Ville', TextType::class, [
                'attr' => ['class' => 'form-control border-black', 'placeholder' => 'Ville *'],
                'label' => ' ',
            ])
            ->add('Postcode', TextType::class, [
                'attr' => ['class' => 'form-control border-black', 'placeholder' => 'Code Postal *'],
                'label' => ' ',
            ])


            // ---------- Rendez-vous ----------
            ->add('DateRendezVous', DateType::class, [
                'attr' => ['class' => 'form-control border-black','placeholder' => 'Date du rendez-vous'],
                'input'  => 'datetime_immutable',
                'widget' => 'single_text',
                'label' => ' ',
            ])
            ->add('HeureRendezVous', TimeType::class, [
                'attr' => ['class' => 'form-control border-black text-center','placeholder' => 'Heure du rendez-vous',],
                'input'  => 'datetime',
                'widget' => 'single_text',
                'label' => ' ',
            ])
            ->add('DureeEstimee', TimeType::class, [
                'attr' => ['class' => 'form-control border-black text-center','placeholder' => 'Durée estimée du rendez-vous'],
                'input'  => 'datetime',
                'widget' => 'single_text',
                'label' => ' ',
                'required' => false,
                'empty_data' => '00:00',
            ])

            ->add('LieuxRendezVous', TextType::class, [
                'attr' => ['class' => 'form-control border-black', 'placeholder' => 'Lieux du rendez-vous *'],
                'label' => ' ',
            ])

            ->add('TypeEtablissement', ChoiceType::class, [
                'choices' => [
                    'Hopital' => 'Hôpital',
                    'Medecin Généraliste' => 'Medecin Généraliste',
                    'Medecin Spécialiste' => 'Medecin Spécialiste',
                    'Autre' => 'Autre',
                ],
                'attr' => ['class' => 'form-control border-black form-select'],
                'label' => ' ',
            ])
            ->add('Prescripteur', TextType::class, [
                'attr' => ['class' => 'form-control border-black', 'placeholder' => 'Médecin prescripteur'],
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
                'attr' => ['class' => 'form-control border-black form-select'],
                'label' => ' ',
            ])

            ->add('ModeTransport', ChoiceType::class, [
                'choices' => [
                    '<div class="appointmentBtn col-lg-6 pe-3 ps-3 me-4 text-center"><img src="assis.png"></div>' => 'assis',
                    '<div class="appointmentBtn col-lg-6 pe-3 ps-3 me-4 text-center"><img src="allonge.png"></div>' => 'allongé',
                ],
                'expanded' => true,
                'label' => ' ',
                'label_html' => true,
            ])
            ->add('Aller', ChoiceType::class, [
                'choices' => [
                    '<div class="appointmentBtn col-lg-6 pe-3 ps-3 me-4 text-center"><img src="aller.png"></div>' => 'aller_simple',
                    '<div class="appointmentBtn col-lg-6 pe-3 ps-3 me-4 text-center"><img src="aller-retour.png"></div>' => 'aller_retour',
                ],
                'expanded' => true,
                'label' => ' ',
                'label_html' => true,
            ])

            ->add('content', TextareaType::class, [
                'attr' => ['class' => 'form-control border-black', 'placeholder' => 'Commentaires éventuels'],
                'required' => false,
                'label' => ' ',
            ])
            ->add('envoyer', SubmitType::class, [
                'attr' => ['class' => 'form-control btn btn-primary'],
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
