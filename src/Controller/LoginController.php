<?php

// Déclaration du namespace du contrôleur
namespace App\Controller;

// Importation de la classe de base pour les contrôleurs Symfony
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
// Importation de la classe Response pour la réponse HTTP
use Symfony\Component\HttpFoundation\Response;
// Importation de l'annotation de routage Symfony
use Symfony\Component\Routing\Annotation\Route;
// Importation de la classe AuthenticationUtils pour l'authentification
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

// Déclaration de la classe du contrôleur
class LoginController extends AbstractController
{
    // Définition de la route '/login' avec le nom 'app_login'
    // Cette méthode gère le processus de connexion
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // Si l'utilisateur est déjà connecté, redirection vers une autre page
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // Récupération de l'erreur d'authentification s'il y en a une
        // getLastAuthenticationError() renvoie null si aucune erreur
        $error = $authenticationUtils->getLastAuthenticationError();
        // Dernier nom d'utilisateur saisi par l'utilisateur
        // getLastUsername() renvoie le nom d'utilisateur saisi lors de la dernière tentative d'authentification
        $lastUsername = $authenticationUtils->getLastUsername();

        // Rendu du template 'security/login.html.twig' avec le dernier nom
        // et l'erreur d'authentification (si elle existe)
        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    // Définition de la route '/logout' avec le nom 'app_logout'
    // Cette méthode gère le processus de déconnexion
    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        // Lève une exception de logique pour indiquer que cette méthode peut être vide et sera interceptée par la clé de déconnexion sur votre pare-feu.
        // pas besoin de mettre en œuvre cette action. Symfony le fera.
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
