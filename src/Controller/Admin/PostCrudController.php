<?php

// Déclaration du namespace du contrôleur
namespace App\Controller\Admin;


// Importation de la classe d'entité Post
use App\Entity\Post;
// Importation de la classe EntityManagerInterface pour la gestion des entités
use Doctrine\ORM\EntityManagerInterface;
// Importation de la classe de base pour les contrôleurs CRUD EasyAdmin
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
// Importation des différents champs de formulaire EasyAdmin
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
// Importation de la classe Response pour la réponse HTTP
use Symfony\Component\HttpFoundation\Response;
// Importation de l'annotation de routage Symfony
use Symfony\Component\Routing\Annotation\Route;
// Importation de la classe SluggerInterface pour la génération de slugs
use Symfony\Component\String\Slugger\SluggerInterface;


#[Route('/',  name: 'app_posts_' )]

// Déclaration de la classe du contrôleur CRUD pour l'entité Post
class PostCrudController extends AbstractCrudController
{
    // Méthode statique pour obtenir le nom complet de l'entité gérée
    public static function getEntityFqcn(): string
    {
        return Post::class;
    }
        // Constantes pour le chemin de base et le répertoire de téléversement des images
        public const POSTS_BASE_PATH = 'upload/images';
        public const POSTS_UPLOAD_DIR = 'public/upload/images';
     
        // Configuration des champs de formulaire pour les différentes pages
        public function configureFields(string $pageName): iterable
        {
            return [
                // Champ d'identifiant (masqué sur le formulaire et l'index)
                IdField::new('id')
                ->hideOnForm()
                ->hideOnIndex(),

                // Champ boolean pour la visibilité (affiché comme un interrupteur)
                BooleanField::new('visible', 'Visible')
                ->renderAsSwitch(true),

                // Champ d'image pour l'URL du média (avec chemin de base et répertoire de téléversement)
                ImageField::new('mediaUrl')
                ->setBasePath(self::POSTS_BASE_PATH)
                ->setUploadDir(self::POSTS_UPLOAD_DIR)
                ->setUploadedFileNamePattern('[slug]-[uuid].[extension]'),

                // Champ de choix pour la page (affiché sous forme de liste déroulante)
                ChoiceField::new('page', 'Page')
                ->setChoices([
                    'Accueil' => 'accueil',
                    'Notre identité' => 'notre-identite',
                    'Prise en charge' => 'prise-en-charge',
                    'Nous rejoindre' => 'nous-rejoindre',
                ])
                ->renderExpanded(),

                // Champ de texte pour le titre
                TextField::new('title', 'Titre'),

                // Champ de texte pour la description
                TextField::new('description', 'Description'),

                // Champ d'éditeur de texte pour le contenu
                TextEditorField::new('content', 'Contenu')
                    ->setFormTypeOption('attr', ['class' => 'tinymce']),

                // Champ de date/heure pour la création (masqué sur le formulaire)
                DateTimeField::new('createdAt', 'Date/Heure de Création')
                ->hideOnForm()
                ->setTimezone('Europe/Paris'),
                
                // Champ de date/heure pour la modification (masqué sur le formulaire)
                DateTimeField::new('updatedAt', 'Date/Heure de Modification')
                ->hideOnForm()
                ->setTimezone('Europe/Paris'),

                // Champ de slug généré à partir du titre (masqué sur le formulaire et l'index)
                SlugField::new('slug')
                ->setTargetFieldName('title')
                ->hideOnForm()
                ->hideOnIndex(),
                
            ];
        }

        // Méthode pour persister une entité dans la base de données
        public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
        {
            // Vérification s'il s'agit d'une instance de l'entité Post (ne pas persister)
            if (!$entityInstance instanceof Post) return;
    
            // Définition de la date de création
            $entityInstance->setCreatedAt(new \DateTimeImmutable);

            // Génération du slug à partir du titre du post
            $slug = $this->slugger->slug($entityInstance->getTitle())->lower();
            $entityInstance->setSlug($slug);        
    
            // Appel de la méthode parent pour persister l'entité
            parent::persistEntity($entityManager, $entityInstance);
        }


        // Méthode pour mettre à jour une entité dans la base de données
        public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
        {
            // Vérification s'il s'agit d'une instance de l'entité Post (ne pas mettre à jour)
            if (!$entityInstance instanceof Post) return;
    
            // Mise à jour de la date de modification
            $entityInstance->setUpdatedAt(new \DateTimeImmutable);      
    
            // Appel de la méthode parent pour mettre à jour l'entité
            parent::updateEntity($entityManager, $entityInstance);
        }


        // Méthode pour supprimer une entité de la base de données
        public function deleteEntity(EntityManagerInterface $entityManager, $entityInstance): void
        {
            // Vérification s'il s'agit d'une instance de l'entité Post
            if (!$entityInstance instanceof Post) {
                return;
            }

            // Récupération du nom de l'image
            $imageName = $entityInstance->getMediaUrl();
            
            // Vérification et suppression de l'image associée
            if ($imageName) {
                $imagePath = $this->getParameter('kernel.project_dir'). '/public/upload/images/'. $imageName;
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            // Appel de la méthode parent pour supprimer l'entité
            parent::deleteEntity($entityManager, $entityInstance);
        }
        
        // Définition de la route '/articles/{slug}' pour afficher un post spécifique
        #[Route('/{slug}', name: 'show', methods: ['GET'])]
        public function show(Post $post): Response
        {
            return $this->render('post/show.html.twig', [
                'post' => $post,
            ]);
        }
        
        // Propriété privée pour l'objet SluggerInterface utilisé pour générer les slugs
        private $slugger;

        // Constructeur du contrôleur, injecte l'objet SluggerInterface
        public function __construct(SluggerInterface $slugger)
        {
            $this->slugger = $slugger;
        }

}
