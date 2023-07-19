<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mime\Part\DataPart;
use Symfony\Component\Mime\Part\File;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, MailerInterface $mailer): Response
    {
        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $data = $form->getData();

            $sexe = $data['Civilite'];
            $lastname = $data['Nom'];
            $firstname = $data['Prenom'];
            $phone = $data['Telephone'];
            $email = $data['email'];
            $subject = $data['sujet'];
            $content = $data['content'];

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

            $email = (new Email())
                ->from($email)
                ->to('admin@admin.com')
                ->subject('Demande de Rendez-vous')
                ->text($message);


            $mailer->send($email);

        }

        return $this->render('main/contact.html.twig', [
            'controller_name' => 'ContactController',
            'formulaire' => $form
        ]);
    }
}
