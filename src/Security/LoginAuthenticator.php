<?php

namespace App\Security;

// Importe la classe Security du bundle Symfony\Bundle\SecurityBundle.
use Symfony\Bundle\SecurityBundle\Security;  
// Importe la classe RedirectResponse du composant Symfony\Component\HttpFoundation.
use Symfony\Component\HttpFoundation\RedirectResponse;  
// Importe la classe Request du composant Symfony\Component\HttpFoundation.
use Symfony\Component\HttpFoundation\Request;  
// Importe la classe Response du composant Symfony\Component\HttpFoundation.
use Symfony\Component\HttpFoundation\Response;  
// Importe l'interface UrlGeneratorInterface du composant Symfony\Component\Routing\Generator.
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;  
// Importe l'interface TokenInterface du composant Symfony\Component\Security\Core\Authentication\Token.
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;  
// Importe la classe AbstractLoginFormAuthenticator du composant Symfony\Component\Security\Http\Authenticator.
use Symfony\Component\Security\Http\Authenticator\AbstractLoginFormAuthenticator; 
// Importe la classe CsrfTokenBadge du composant Symfony\Component\Security\Http\Authenticator\Passport\Badge. 
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\CsrfTokenBadge;  
// Importe la classe UserBadge du composant Symfony\Component\Security\Http\Authenticator\Passport\Badge.
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;  
// Importe la classe PasswordCredentials du composant Symfony\Component\Security\Http\Authenticator\Passport\Credentials.
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;  
// Importe la classe Passport du composant Symfony\Component\Security\Http\Authenticator\Passport.
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;  
// Importe le trait TargetPathTrait du composant Symfony\Component\Security\Http\Util.
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
