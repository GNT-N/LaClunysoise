<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, MailerInterface $mailer): Response
    {
        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $data = $form->getData();

            $gender = $data['Civilite'];
            $lastname = $data['Nom'];
            $firstname = $data['Prenom'];
            $phone = $data['Telephone'];
            $email = $data['email'];
            $subject = $data['sujet'];
            $content = $data['content'];

            if ((empty($email) && is_null($email)) || (empty($content) && is_null($content))) {
                $this->addFlash('danger', 'Les champs du formulaire sont obligatoires.');
                return $this->redirectToRoute('app_contact');
            }
            

            $message = sprintf(

                "Nouveau message ,\n\nObject: %s\n\nCivilité: %s\n\nNom: %s\nPrénom: %s\n\nTéléphone: %s\nAdresse e-mail: %s\n\nCommentaires: \n%s",

                $subject,
                $gender,
                $lastname,
                $firstname,
                $phone,
                $email,
                $content
            );

            $email = (new Email())
                ->from($email)
                ->to('admin@admin.com')
                ->subject('Demande de Rendez-vous')
                ->text($message);


            $mailer->send($email);

            // Ajout du message flash dans la session
            $this->addFlash('success', 'Votre message a été envoyé avec succès !');

            // Rediriger l'utilisateur après envoi du formulaire pour éviter de le renvoyer en actualisant la page (Post-Redirect-Get pattern)
            return $this->redirectToRoute('app_contact');

        }

        return $this->render('main/contact.html.twig', [
            'controller_name' => 'ContactController',
            'formulaire' => $form
        ]);
    }
}
