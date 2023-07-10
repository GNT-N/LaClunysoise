<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    // Annotation de route pour la méthode login()
    #[Route(path: '/login', name: 'app_login')] 
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // Récupération de l'erreur de connexion s'il y en a une
        $error = $authenticationUtils->getLastAuthenticationError(); 
        // Récupération du dernier nom d'utilisateur saisi par l'utilisateur
        $lastUsername = $authenticationUtils->getLastUsername(); 

        // Rendu du template 'security/login.html.twig' avec les variables 'last_username' et 'error' passées au template
        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]); 
    }

    // Annotation de route pour la méthode logout()
    #[Route(path: '/logout', name: 'app_logout')] 
    public function logout(): void
    {
        // Lancement d'une exception indiquant que cette méthode peut être vide et sera interceptée par la clé de déconnexion de votre pare-feu
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.'); 
    }
}
