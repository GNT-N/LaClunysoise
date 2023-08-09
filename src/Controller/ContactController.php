<?php

namespace App\Controller;

// Importation des classes nécessaires
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

// Définition de la classe ContactController qui hérite de AbstractController
class ContactController extends AbstractController
{
    // Définition de la route '/contact' avec le nom 'app_contact'
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, MailerInterface $mailer): Response
    {
        // Création du formulaire de contact
        $form = $this->createForm(ContactType::class);

        // Gestion de la requête du formulaire
        $form->handleRequest($request);

        // Vérification si le formulaire est soumis et valide
        if ($form->isSubmitted() && $form->isValid()) {

            // Récupération des données du formulaire
            $data = $form->getData();

            // Extraction des données du formulaire
            $sexe = $data['Civilite'];
            $lastname = $data['Nom'];
            $firstname = $data['Prenom'];
            $phone = $data['Telephone'];
            $email = $data['email'];
            $subject = $data['sujet'];
            $content = $data['content'];

            // Vérification si l'email ou le contenu est vide
            if ((empty($email) && is_null($email)) || (empty($content) && is_null($content))) {
                // Ajout d'un message flash d'erreur
                $this->addFlash('danger', 'Les champs du formulaire sont obligatoires.');
                // Redirection vers le formulaire de contact
                return $this->redirectToRoute('app_contact');
            }

            // Création du message à envoyer
            $message = sprintf(
                "Nouveau message ,\n\nObject: %s\n\nCivilité: %s\n\nNom: %s\nPrénom: %s\n\nTéléphone: %s\nAdresse e-mail: %s\n\nCommentaires: \n%s",
                $subject,
                $sexe,
                $lastname,
                $firstname,
                $phone,
                $email,
                $content
            );

            // Création de l'email
            $email = (new Email())
                ->from($email)
                ->to('admin@admin.com')
                ->subject('Demande de Rendez-vous')
                ->text($message);

            // Envoi de l'email
            $mailer->send($email);

            // Ajout d'un message flash de succès
            $this->addFlash('success', 'Votre message a été envoyé avec succès !');

            // Redirection vers le formulaire de contact pour éviter le renvoi du formulaire en actualisant la page (Post-Redirect-Get pattern)
            return $this->redirectToRoute('app_contact');
        }

        // Rendu du template avec le formulaire
        return $this->render('main/contact.html.twig', [
            'controller_name' => 'ContactController',
            'formulaire' => $form
        ]);
    }
}