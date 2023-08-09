<?php

// Déclaration du namespace du contrôleur
namespace App\Controller\Admin;

// Importation des classes nécessaires
use App\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

// Définition de la route et du nom de la route
#[Route('/', name: 'app_posts_')]
class PostCrudController extends AbstractCrudController
{
    // Méthode pour obtenir le nom complet de l'entité gérée
    public static function getEntityFqcn(): string
    {
        return Post::class;
    }

    // Méthode pour configurer les actions du CRUD
    public function configureActions(Actions $actions): Actions
    {
        // Configuration des labels des actions
        return $actions
            ->update(Crud::PAGE_INDEX, Action::EDIT, function (Action $action) {
                return $action->setLabel('Modifier');
            })
            ->update(Crud::PAGE_INDEX, Action::DELETE, function (Action $action) {
                return $action->setLabel('Supprimer');
            })
            ->update(Crud::PAGE_NEW, Action::SAVE_AND_RETURN, function (Action $action) {
                return $action->setLabel('Sauvegarder et quitter');
            })
            ->update(Crud::PAGE_NEW, Action::SAVE_AND_ADD_ANOTHER, function (Action $action) {
                return $action->setLabel('Sauvegarder et continuer');
            })
            ->update(Crud::PAGE_EDIT, Action::SAVE_AND_RETURN, function (Action $action) {
                return $action->setLabel('Sauvegarder et quitter');
            })
            ->update(Crud::PAGE_EDIT, Action::SAVE_AND_CONTINUE, function (Action $action) {
                return $action->setLabel('Sauvegarder et continuer');
            });
    }

    // Constantes pour le chemin de base et le répertoire de téléversement des images
    public const POSTS_BASE_PATH = 'upload/images';
    public const POSTS_UPLOAD_DIR = 'public/upload/images';

    // Méthode pour configurer les champs du formulaire
    public function configureFields(string $pageName): iterable
    {
        // Configuration des champs du formulaire
        return [
            IdField::new('id')->hideOnForm()->hideOnIndex(),
            BooleanField::new('visible', 'Visible')->renderAsSwitch(true),
            ImageField::new('mediaUrl')->setBasePath(self::POSTS_BASE_PATH)->setUploadDir(self::POSTS_UPLOAD_DIR)->setUploadedFileNamePattern('[slug]-[uuid].[extension]'),
            ChoiceField::new('page', 'Page')->setChoices(['Accueil' => 'accueil', 'Notre identité' => 'notre-identite', 'Prise en charge' => 'prise-en-charge', 'Nous rejoindre' => 'nous-rejoindre'])->renderExpanded(),
            TextField::new('title', 'Titre'),
            TextField::new('description', 'Description'),
            TextEditorField::new('content', 'Contenu')->setFormTypeOption('attr', ['class' => 'tinymce']),
            DateTimeField::new('createdAt', 'Date/Heure de Création')->hideOnForm()->setTimezone('Europe/Paris'),
            DateTimeField::new('updatedAt', 'Date/Heure de Modification')->hideOnForm()->setTimezone('Europe/Paris'),
            SlugField::new('slug')->setTargetFieldName('title')->hideOnForm()->hideOnIndex(),
        ];
    }

    // Méthode pour persister une entité dans la base de données
    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        // Vérification s'il s'agit d'une instance de l'entité Post
        if (!$entityInstance instanceof Post)
            return;
        // Définition de la date de création et génération du slug
        $entityInstance->setCreatedAt(new \DateTimeImmutable);
        $slug = $this->slugger->slug($entityInstance->getTitle())->lower();
        $entityInstance->setSlug($slug);
        // Appel de la méthode parent pour persister l'entité
        parent::persistEntity($entityManager, $entityInstance);
    }

    // Méthode pour mettre à jour une entité dans la base de données
    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        // Vérification s'il s'agit d'une instance de l'entité Post
        if (!$entityInstance instanceof Post)
            return;
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
        // Récupération du nom de l'image et suppression de l'image associée
        $imageName = $entityInstance->getMediaUrl();
        if ($imageName) {
            $imagePath = $this->getParameter('kernel.project_dir') . '/public/upload/images/' . $imageName;
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        // Appel de la méthode parent pour supprimer l'entité
        parent::deleteEntity($entityManager, $entityInstance);
    }

    // Définition de la route pour afficher un post spécifique
    #[Route('/{slug}', name: 'show', methods: ['GET'])]
    public function show(Post $post): Response
    {
        // Rendu de la vue avec le post en paramètre
        return $this->render('post/show.html.twig', [
            'post' => $post,
        ]);
    }

    // Propriété pour l'objet SluggerInterface
    private $slugger;

    // Constructeur du contrôleur, injection de l'objet SluggerInterface
    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }
}