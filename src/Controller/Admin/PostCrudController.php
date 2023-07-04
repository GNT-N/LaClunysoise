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
use Symfony\Component\String\Slugger\SluggerInterface;

class PostCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Post::class;
    }
        public const POSTS_BASE_PATH = 'upload/images';
        public const POSTS_UPLOAD_DIR = 'public/upload/images';
        public function configureFields(string $pageName): iterable
        {
            return [
                IdField::new('id')
                ->hideOnForm()
                ->hideOnIndex(),
                BooleanField::new('visible', 'Visible'),
                TextField::new('title', 'Titre'),
                TextField::new('description', 'Description'),
                TextEditorField::new('content', 'Contenu'),

                ImageField::new('mediaUrl')
                    ->setBasePath(self::POSTS_BASE_PATH)
                    ->setUploadDir(self::POSTS_UPLOAD_DIR),

                DateTimeField::new('createdAt', 'Date/Heure de Création')
                ->hideOnForm()
                ->setTimezone('Europe/Paris'),
                DateTimeField::new('updatedAt', 'Date/Heure de Modification')
                ->hideOnForm()
                ->setTimezone('Europe/Paris'),

            ChoiceField::new('page', 'Page')
                ->setChoices([
                    'Accueil' => 'accueil',
                    'À propos' => 'a-propos',
                    'Prise en charge' => 'prise-en-charge',
                    'Nous rejoindre' => 'nous-rejoindre',
                ])
                ->renderExpanded(),

                SlugField::new('slug')
                ->setTargetFieldName('title')
                ->hideOnForm()
                ->hideOnIndex(),
                
            ];
        }

        public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
        {
            if ($entityInstance instanceof Category) return;
    
            $entityInstance->setCreatedAt(new \DateTimeImmutable);

            // Générer le slug à partir du titre du post
            $slug = $this->slugger->slug($entityInstance->getTitle())->lower();
            $entityInstance->setSlug($slug);        
    
            parent::persistEntity($entityManager, $entityInstance);
        }

        
        private $slugger;
        public function __construct(SluggerInterface $slugger)
        {
            $this->slugger = $slugger;
        }

        public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
        {
            if ($entityInstance instanceof Category) return;
    
            $entityInstance->setUpdatedAt(new \DateTimeImmutable);      
    
            parent::updateEntity($entityManager, $entityInstance);
        }

}
