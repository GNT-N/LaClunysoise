<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Civilite', ChoiceType::class, [
                'choices' => [
                    'M.' => 'Monsieur',
                    'Mme' => 'Madame',
                ],
                'attr' => ['class' => 'form-control'],
                'label' => ' ',
            ])
            ->add('Nom',TextType::class, [
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
            ->add('email', TextType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'email'],
                'label' => ' ',
            ])
            ->add('sujet', TextType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'objet'],
                'label' => ' ',
            ])
            ->add('content', TextareaType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Contenu'],
                'label' => ' ',
            ])
            
            ->add('envoyer', SubmitType::class, [
                'attr' => ['class' => 'form-control mt-5'],
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
