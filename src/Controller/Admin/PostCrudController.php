<?php

namespace App\Controller\Admin;

use App\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\String\Slugger\SluggerInterface;


#[Route('/',  name: 'app_posts_' )]
class PostCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        // Retourne la classe de l'entité associée (ici, la classe "Post")
        return Post::class;
    }

        // deux constantes sont définies pour le chemin de base des téléchargements d'images et le répertoire de téléchargement.
        public const POSTS_BASE_PATH = 'upload/images';
        public const POSTS_UPLOAD_DIR = 'public/upload/images';
        public function configureFields(string $pageName): iterable
        {
            // Retourne un tableau des champs à afficher dans les différentes pages du CRUD
            return [

                // Champ ID (masqué dans le formulaire et dans l'index)
                IdField::new('id')
                ->hideOnForm()
                ->hideOnIndex(),

                // Champ booléen "visible" (affiché comme un interrupteur)
                BooleanField::new('visible', 'Visible')
                ->renderAsSwitch(true),

                // Champ d'image avec le chemin de base et le répertoire de téléchargement configurés
                ImageField::new('mediaUrl')
                ->setBasePath(self::POSTS_BASE_PATH)
                ->setUploadDir(self::POSTS_UPLOAD_DIR)
                ->setUploadedFileNamePattern('[slug]-[uuid].[extension]'),

                // Champ de texte "title" avec étiquette "Titre"
                TextField::new('title', 'Titre'),

                // Champ de texte "description" avec étiquette "Description"
                TextField::new('description', 'Description'),

                // Champ d'éditeur de texte "content" avec étiquette "Contenu"
                TextEditorField::new('content', 'Contenu'),

                // Champ de date/heure "createdAt" avec étiquette "Date/Heure de Création" (masqué dans le formulaire)
                DateTimeField::new('createdAt', 'Date/Heure de Création')
                ->hideOnForm()
                ->setTimezone('Europe/Paris'),
                
                // Champ de date/heure "updatedAt" avec étiquette "Date/Heure de Modification" (masqué dans le formulaire)
                DateTimeField::new('updatedAt', 'Date/Heure de Modification')
                ->hideOnForm()
                ->setTimezone('Europe/Paris'),

                // Champ de choix "page" avec étiquette "Page" et options prédéfinies
                ChoiceField::new('page', 'Page')
                ->setChoices([
                    'Accueil' => 'accueil',
                    'À propos' => 'a-propos',
                    'Prise en charge' => 'prise-en-charge',
                    'Nous rejoindre' => 'nous-rejoindre',
                ])
                ->renderExpanded(),

                // Champ de slug basé sur le champ "title" (masqué dans le formulaire et dans l'index)
                SlugField::new('slug')
                ->setTargetFieldName('title')
                ->hideOnForm()
                ->hideOnIndex(),
                
            ];
        }

        public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
        {
            // Vérifie si l'instance d'entité est de type "Post"
            if (!$entityInstance instanceof Post) return;
    
            // Définit la date de création à l'instant actuel
            $entityInstance->setCreatedAt(new \DateTimeImmutable);

            // Générer le slug à partir du titre du post
            $slug = $this->slugger->slug($entityInstance->getTitle())->lower();
            $entityInstance->setSlug($slug);        
    
            // Appelle la méthode parente pour persister l'entité
            parent::persistEntity($entityManager, $entityInstance);
        }

        public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
        {
            // Vérifie si l'instance d'entité est de type "Post"
            if (!$entityInstance instanceof Post) return;
    
            // Définit la date de modification à l'instant actuel
            $entityInstance->setUpdatedAt(new \DateTimeImmutable);      
    
            // Appelle la méthode parente pour mettre à jour l'entité
            parent::updateEntity($entityManager, $entityInstance);
        }

        public function deleteEntity(EntityManagerInterface $entityManager, $entityInstance): void
        {
            // Vérifie si l'instance d'entité est de type "Post"
            if (!$entityInstance instanceof Post) {
                return;
            }

            // Récupère le nom de l'image associée à l'entité
            $imageName = $entityInstance->getMediaUrl();
            if ($imageName) {
                // Construit le chemin complet de l'image
                $imagePath = $this->getParameter('kernel.project_dir'). '/public/upload/images/'. $imageName;
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            // Appelle la méthode parente pour supprimer l'entité
            parent::deleteEntity($entityManager, $entityInstance);
        }

        private $slugger;
        public function __construct(SluggerInterface $slugger)
        {
            // Injecte le service SluggerInterface dans la propriété $slugger
            $this->slugger = $slugger;
        }

}
