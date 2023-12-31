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
use Symfony\Component\Validator\Constraints\File;


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
                'attr' => ['class' => 'form-control mt-4 border-black form-select'],
                'label' => ' ',
                'required' => true,
            ])
            ->add('Nom',TextType::class, [
                'attr' => ['class' => 'form-control mt-4 border-black', 'placeholder' => 'Nom *'],
                'label' => ' ',
                'required' => true,
            ])
            ->add('Prenom', TextType::class, [
                'attr' => ['class' => 'form-control mt-4 border-black', 'placeholder' => 'Prénom *'],
                'label' => ' ',
                'required' => true,
            ])
            ->add('Telephone', TextType::class, [
                'attr' => ['class' => 'form-control mt-4 border-black', 'placeholder' => 'Téléphone *'],
                'label' => ' ',
                'required' => true,
            ])
            ->add('email', EmailType::class, [
                'attr' => ['class' => 'form-control mt-4 border-black', 'placeholder' => 'email *'],
                'label' => ' ',
                'required' => true,
            ])
            ->add('content', TextareaType::class, [
                'attr' => ['class' => 'form-control mt-4 border-black', 'placeholder' => 'Contenu *'],
                'label' => ' ',
                'required' => true,
            ])
            ->add('Fichier', FileType::class, [
                'label' => ' ',
                'required' => true,
                'attr' => ['class' => 'form-control-file mt-4 border-black'],
                'constraints' => [
                    new File([
                        'mimeTypes' => [
                            'application/pdf',
                        ],
                        'mimeTypesMessage' => 'Veuillez télécharger un document PDF.',
                    ]),
                ],
            ])
            ->add('envoyer', SubmitType::class, [
            'attr' => ['class' => 'form-control mt-4 btn btn-primary'],
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
