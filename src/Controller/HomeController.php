<?php

namespace App\Controller;

use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PostRepository;

#[Route('/', name: 'home')]
class HomeController extends AbstractController
{
    #[Route('/{slug}', name: 'show', methods: ['GET'])]
    public function show(Post $post): Response
    {
        return $this->render('post/show.html.twig', [
            'post' => $post,
        ]);
    }

    #[Route('/', name: 'main')]
    public function acceuil(PostRepository $postRepository): Response
    {
        return $this->render('home/accueil.html.twig', [
            'post' => $postRepository->findBy(array('page' => 'accueil', 'visible' => true)),
        ]);
    }

    #[Route('/about', name: 'about')]
    public function about(PostRepository $postRepository): Response
    {
        return $this->render('/about.html.twig', [
            'post' => $postRepository->findBy(array('page' => 'a-propos', 'visible' => true)),
        ]);
    }
}
