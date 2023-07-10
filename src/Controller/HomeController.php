<?php

namespace App\Controller;

use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PostRepository;

// Annotation de route pour la classe HomeController
#[Route('/', name: 'home')] 
class HomeController extends AbstractController
{
    // Annotation de route pour la méthode show()
    #[Route('/{slug}', name: 'show', methods: ['GET'])] 
    public function show(Post $post): Response
    {
        // Rendu du template 'post/show.html.twig'
        return $this->render('post/show.html.twig', [ 
            // Passage de la variable 'post' au template
            'post' => $post, 
        ]);
    }

    // Annotation de route pour la méthode acceuil()
    #[Route('/', name: 'main')] 
    public function acceuil(PostRepository $postRepository): Response
    {
        // Rendu du template 'home/accueil.html.twig'
        return $this->render('home/accueil.html.twig', [ 
            // Récupération des entités 'Post' par le biais du 'PostRepository' avec des critères de recherche spécifiques
            'post' => $postRepository->findBy(array('page' => 'accueil', 'visible' => true)), 
        ]);
    }

    // Annotation de route pour la méthode about()
    #[Route('/about', name: 'about')] 
    public function about(PostRepository $postRepository): Response
    {
        // Rendu du template '/about.html.twig'
        return $this->render('/about.html.twig', [ 
            // Récupération des entités 'Post' par le biais du 'PostRepository' avec des critères de recherche spécifiques
            'post' => $postRepository->findBy(array('page' => 'a-propos', 'visible' => true)), 
        ]);
    }
}
