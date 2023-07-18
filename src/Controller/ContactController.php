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

            $address = $data['email'];
            $content = $data['content'];
            $subject = $data['subject'];

            $email = (new Email())
                ->from($address)
                ->to('admin@admin.com')
                ->subject($subject)
                ->text($content);


            $mailer->send($email);

        }

        return $this->render('main/contact.html.twig', [
            'controller_name' => 'ContactController',
            'formulaire' => $form
        ]);
    }
}
