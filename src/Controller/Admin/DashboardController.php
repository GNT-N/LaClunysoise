<?php

namespace App\Controller\Admin;

use App\Entity\Post;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    public function __construct(
        // Injection de dépendance pour AdminUrlGenerator
        private AdminUrlGenerator $adminUrlGenerator 
    ) {}
    
    // Annotation de route pour la méthode index()
    #[Route('/admin', name: 'admin')] 
    public function index(): Response
    {
        // return parent::index();

        // Stockage de l'URL générée par AdminUrlGenerator
        $url = $this->adminUrlGenerator 

            // Définition du contrôleur pour l'URL générée
            ->setController(PostCrudController::class) 
            // Génération de l'URL
            ->generateUrl(); 
    
        // Redirection vers l'URL générée
        return $this->redirect($url); 
    }
    
    public function configureDashboard(): Dashboard
    {
        // Création d'une nouvelle instance de Dashboard
        return Dashboard::new() 
            // Définition du titre du tableau de bord
            ->setTitle('La Clunysoise Administration'); 
    }
    
    public function configureMenuItems(): iterable
    {
        // Création d'un sous-menu avec le libellé "Publications" et la classe CSS "fa fa-newspaper"
        yield MenuItem::subMenu('Publications', 'fa fa-newspaper') 
            // Configuration des sous-éléments du sous-menu    
            ->setSubItems([ 
                // Lien CRUD "Nouveau post" avec une icône et une action spécifiées
                MenuItem::linkToCrud('Nouveau post', 'fas fa-plus', Post::class)->setAction(Crud::PAGE_NEW),
                // Lien CRUD "Voir post" avec une icône spécifiée 
                MenuItem::linkToCrud('Voir post', 'fas fa-eye', Post::class),
                // Lien vers une URL externe avec une icône spécifiée 
                MenuItem::linkToUrl('Accéder au site', 'fa fa-globe', '/') 
            ]);
    }
    
}
