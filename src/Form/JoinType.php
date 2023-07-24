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
use Symfony\Component\Form\Extension\Core\Type\FileType;


class JoinType extends AbstractType
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
            ->add('Nom',TextType::class, [
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
            ->add('content', TextareaType::class, [
                'attr' => ['class' => 'form-control mt-4', 'placeholder' => 'Contenu'],
                'label' => ' ',
            ])
            ->add('Fichier', FileType::class, [
                'label' => ' ',
                'required' => false,
                'attr' => ['class' => 'form-control mt-4'],
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