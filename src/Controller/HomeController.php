<?php

// Déclaration du namespace du contrôleur
namespace App\Controller;

// Importation de la classe d'entité Post
use App\Entity\Post;
// Importation de la classe de base pour les contrôleurs Symfony
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
// Importation de la classe Response pour la réponse HTTP
use Symfony\Component\HttpFoundation\Response;
// Importation de l'annotation de routage Symfony
use Symfony\Component\Routing\Annotation\Route;
// Importation du repository de l'entité Post
use App\Repository\PostRepository;


// Déclaration de la classe du contrôleur
class HomeController extends AbstractController
{
    // Définition de la route '/' avec le nom 'main'
    #[Route('/', name: 'main')]
    public function acceuil(PostRepository $postRepository): Response
    {
        // Rendu du template 'home/accueil.html.twig' avec les posts filtrés par page et visibilité
        return $this->render('main/accueil.html.twig', [
            'post' => $postRepository->findBy(array('page' => 'accueil', 'visible' => true)),
        ]);
    }

    // Définition de la route '/about' avec le nom 'about'
    #[Route('/a-propos', name: 'about')]
    public function about(PostRepository $postRepository): Response
    {
        // Rendu du template '/about.html.twig' avec les posts filtrés par page et visibilité
        return $this->render('main/about.html.twig', [
            'post' => $postRepository->findBy(array('page' => 'a-propos', 'visible' => true)),
        ]);
    }
}
