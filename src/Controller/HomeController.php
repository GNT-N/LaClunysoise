<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PostRepository;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function acceuil(PostRepository $postRepository): Response
    {
        return $this->render('home/accueil.html.twig', [
            'post' => $postRepository->findBy(array('page' => 'accueil'))
        ]);
    }

    #[Route('/about', name: 'about')]
    public function about(PostRepository $postRepository): Response
    {
        return $this->render('/about.html.twig', [
            'post' => $postRepository->findBy(array('page' => 'a-propos'))
        ]);
    }
}
