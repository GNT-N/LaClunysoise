<?php

// Déclaration du namespace du contrôleur
namespace App\Controller;

// Importation des classes nécessaires
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PostRepository;

// Déclaration de la classe du contrôleur
class HomeController extends AbstractController
{
    // Définition de la route '/' avec le nom 'main'
    // Cette méthode est utilisée pour afficher la page d'accueil
    #[Route('/', name: 'main')]
    public function acceuil(PostRepository $postRepository): Response
    {
        // Rendu du template 'main/home.html.twig' avec les posts filtrés par page et visibilité
        // Les posts sont filtrés pour n'afficher que ceux qui sont visibles et qui appartiennent à la page d'accueil
        return $this->render('main/home.html.twig', [
            'post' => $postRepository->findBy(array('page' => 'accueil', 'visible' => true)),
        ]);
    }

    // Définition de la route '/about' avec le nom 'about'
    // Cette méthode est utilisée pour afficher la page 'Notre Identité'
    #[Route('/notre-identite', name: 'about')]
    public function about(PostRepository $postRepository): Response
    {
        // Rendu du template '/aboutus.html.twig' avec les posts filtrés par page et visibilité
        // Les posts sont filtrés pour n'afficher que ceux qui sont visibles et qui appartiennent à la page 'Notre Identité'
        return $this->render('main/aboutus.html.twig', [
            'post' => $postRepository->findBy(array('page' => 'notre-identite', 'visible' => true)),
        ]);
    }

    // Définition de la route '/prise-en-charge' avec le nom 'supportPricing'
    // Cette méthode est utilisée pour afficher la page 'Prise en charge'
    #[Route('/prise-en-charge', name: 'supportPricing')]
    public function supportPricing(PostRepository $postRepository): Response
    {
        // Rendu du template '/supportPricing.html.twig' avec les posts filtrés par page et visibilité
        // Les posts sont filtrés pour n'afficher que ceux qui sont visibles et qui appartiennent à la page 'Prise en charge'
        return $this->render('main/supportPricing.html.twig', [
            'post' => $postRepository->findBy(array('page' => 'prise-en-charge', 'visible' => true)),
        ]);
    }

    // Définition de la route '/joinus' avec le nom 'joinus'
    // Cette méthode est utilisée pour rediriger vers le contrôleur 'JoinController'
    #[Route('/nous-rejoindre', name: 'joinus')]
    public function joinus(PostRepository $postRepository): Response
    {
        // Redirection vers le contrôleur 'JoinController'
        return $this->forward('App\Controller\JoinController::index');
    }

    // Définition de la route '/vos-rendez-vous' avec le nom 'appointment'
    // Cette méthode est utilisée pour rediriger vers le contrôleur 'AppointmentController'
    #[Route('/vos-rendez-vous', name: 'appointment')]
    public function appointment(PostRepository $postRepository): Response
    {
        // Redirection vers le contrôleur 'AppointmentController'
        return $this->forward('App\Controller\AppointmentController::index');
    }

    // Définition de la route '/contact' avec le nom 'contact'
    // Cette méthode est utilisée pour afficher la page 'Contact'
    #[Route('/contact', name: 'contact')]
    public function contact(PostRepository $postRepository): Response
    {
        // Rendu du template '/contact.html.twig'
        return $this->render('main/contact.html.twig');
    }
}