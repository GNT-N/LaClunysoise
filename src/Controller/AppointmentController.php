<?php

namespace App\Controller;

use App\Form\AppointmentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class AppointmentController extends AbstractController
{
    #[Route('/vos-rendez-vous', name: 'app_appointment')]    
    public function index(Request $request, MailerInterface $mailer): Response
    {
        $form = $this->createForm(AppointmentType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $data = $form->getData();

            $address = $data['email'];
            $content = $data['content'];

            $email = (new Email())
                ->from($address)
                ->to('admin@admin.com')
                ->subject('Demande de contact')
                ->text($content);


            $mailer->send($email);

        }
        return $this->render('main/appointment.html.twig', [
            'controller_name' => 'AppointmentController',
            'formulaire' => $form
        ]);
    }
}
