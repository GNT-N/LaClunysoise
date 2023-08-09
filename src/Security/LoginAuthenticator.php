<?php

namespace App\Security;

// Importation les classes nécessaires
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authenticator\AbstractLoginFormAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\CsrfTokenBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Util\TargetPathTrait;


class LoginAuthenticator extends AbstractLoginFormAuthenticator
{
    // Utilise le trait TargetPathTrait.
    use TargetPathTrait;
    // Déclare une constante LOGIN_ROUTE avec la valeur 'app_login'.
    public const LOGIN_ROUTE = 'app_login';

    public function __construct(private UrlGeneratorInterface $urlGenerator)
    {
    }

    public function authenticate(Request $request): Passport
    {
        // Récupère la valeur du paramètre 'username' de la requête HTTP.
        $username = $request->request->get('username', '');

        // Enregistre le nom d'utilisateur dans la session de la requête.
        $request->getSession()->set(Security::LAST_USERNAME, $username);
        return new Passport(
                // Crée un badge d'utilisateur avec le nom d'utilisateur.
            new UserBadge($username),
                // Crée des informations d'identification de mot de passe à partir du paramètre 'password' de la requête HTTP.
            new PasswordCredentials($request->request->get('password', '')),
            [
                    // Crée un badge de jeton CSRF à partir du paramètre '_csrf_token' de la requête HTTP.
                new CsrfTokenBadge('authenticate', $request->request->get('_csrf_token')),
            ]
        );
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        // Récupère le chemin de redirection cible à partir de la session de la requête.
        if ($targetPath = $this->getTargetPath($request->getSession(), $firewallName)) {
            // Redirige vers le chemin de redirection cible.
            return new RedirectResponse($targetPath);
        }

        // Redirige vers la route 'admin' générée par le générateur d'URL.
        return new RedirectResponse($this->urlGenerator->generate('admin'));
    }

    protected function getLoginUrl(Request $request): string
    {
        // Retourne l'URL de la route de connexion (LOGIN_ROUTE).
        return $this->urlGenerator->generate(self::LOGIN_ROUTE);
    }
}