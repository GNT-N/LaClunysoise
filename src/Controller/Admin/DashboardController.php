<?php

// Déclaration du namespace du contrôleur
namespace App\Controller\Admin;

// Importation de la classe d'entité Post
use App\Entity\Post;
// Importation des classes de configuration du tableau de bord et du menu
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
// Importation de la classe de base pour les contrôleurs du tableau de bord EasyAdmin
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
// Importation de la classe pour générer les URL du tableau de bord EasyAdmin
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
// Importation de la classe pour la réponse HTTP
use Symfony\Component\HttpFoundation\Response;
// Importation de l'annotation de routage Symfony
use Symfony\Component\Routing\Annotation\Route;

// Déclaration de la classe du contrôleur du tableau de bord
class DashboardController extends AbstractDashboardController
{
    // Déclaration d'une propriété privée pour l'AdminUrlGenerator
    private $adminUrlGenerator;

    // Injection de dépendance de l'AdminUrlGenerator dans le constructeur
    public function __construct(AdminUrlGenerator $adminUrlGenerator)
    {
        $this->adminUrlGenerator = $adminUrlGenerator;
    }

    // Définition de la route '/admin' avec le nom 'admin'
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // Génération de l'URL pour la page d'accueil du tableau de bord
        $url = $this->adminUrlGenerator
            ->setController(PostCrudController::class)
            ->generateUrl();

        // Redirection vers l'URL générée
        return $this->redirect($url);
    }

    // Configuration du tableau de bord
    public function configureDashboard(): Dashboard
    {
        // Création d'un nouvel objet Dashboard et définition de son titre
        return Dashboard::new()
            ->setTitle('La Clunysoise Administration')
            ->setFaviconPath('favicon.svg');
    }

    // Configuration des éléments de menu
    public function configureMenuItems(): iterable
    {
        // Utilisation de la syntaxe 'yield' pour créer un itérable d'objets MenuItem
        yield MenuItem::subMenu('Publications', 'fa fa-newspaper')->setSubItems([
            // Création d'un lien vers la création d'un nouveau post avec une icône et une action
            MenuItem::linkToCrud('Nouveau post', 'fas fa-plus', Post::class)->setAction(Crud::PAGE_NEW),
            // Création d'un lien vers la visualisation des posts existants
            MenuItem::linkToCrud('Voir post', 'fas fa-eye', Post::class),
            // Création d'un lien vers l'accès au site principal
            MenuItem::linkToUrl('Accéder au site', 'fa fa-globe', '/')
        ]);
    }
}