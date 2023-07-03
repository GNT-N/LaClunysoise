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
        private AdminUrlGenerator $adminUrlGenerator
        ) {
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // return parent::index();
        $url = $this->adminUrlGenerator
        ->setController(PostCrudController::class)
        ->generateUrl();

        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('La Clunysoise Administration');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::subMenu('Acceuil', 'fa fa-home')->setSubItems([
                MenuItem::linkToCrud('Nouveau post', 'fas fa-plus', Post::class)->setAction(Crud::PAGE_NEW),
                MenuItem::linkToCrud('Voir post', 'fas fa-eye', Post::class)
        ]);

        yield MenuItem::subMenu('A propos', 'fa fa-people-group')->setSubItems([
            MenuItem::linkToCrud('Nouveau post', 'fas fa-plus', Post::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Voir post', 'fas fa-eye', Post::class)
        ]);

        yield MenuItem::subMenu('Prise en charge', 'fa fa-newspaper')->setSubItems([
            MenuItem::linkToCrud('Nouveau post', 'fas fa-plus', Post::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Voir post', 'fas fa-eye', Post::class)
        ]);

        yield MenuItem::subMenu('Nous rejoindre', 'fa fa-user-plus')->setSubItems([
            MenuItem::linkToCrud('Nouveau post', 'fas fa-plus', Post::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Voir post', 'fas fa-eye', Post::class)
        ]);
    }
}
