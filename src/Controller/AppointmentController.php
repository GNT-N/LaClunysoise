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

            $sexe = $data['Civilite'];
            $lastname = $data['Nom'];
            $firstname = $data['Prenom'];
            $phone = $data['Telephone'];
            $email = $data['email'];

            $street = $data['Rue'];
            $city = $data['Ville'];
            $postcode = $data['Postcode'];

            $date = $data['DateRendezVous']->format('d-m-Y');
            $time = $data['HeureRendezVous']->format('H:i');
            $during = $data['DureeEstimee'];
            $place = $data['LieuxRendezVous'];
            $prescripteur = $data['Prescripteur'];
            $motif = $data['Motif'];
            $type = $data['TypeEtablissement'];
            $transport = $data['ModeTransport'];
            $go = $data['Aller'];
            $content = $data['content'];

            // Convertir la valeur de $date en un objet DateTimeImmutable
            $date = new \DateTimeImmutable($data['DateRendezVous']->format('Y-m-d'));

            // Convertir la valeur de $during en un objet DateTimeImmutable (si ce n'est pas déjà fait dans le formulaire)
            $during = new \DateTimeImmutable($data['DureeEstimee']->format('H:i'));

            // Convertir la valeur de $time en un objet DateTimeImmutable (si ce n'est pas déjà fait dans le formulaire)
            $time = new \DateTimeImmutable($data['HeureRendezVous']->format('H:i'));

            // Vérifier si l'heure du rendez-vous est en dehors de la plage horaire autorisée (9h à 18h)
            $startHour = new \DateTimeImmutable('06:00');
            $endHour = new \DateTimeImmutable('20:00');

            if ($time < $startHour || $time > $endHour) {
                // Heure de rendez-vous en dehors de la plage horaire autorisée, afficher un message d'erreur
                $this->addFlash('error', 'Les rendez-vous ne sont autorisés qu\'entre 9h et 18h.');
                return $this->redirectToRoute('app_appointment');
            }

            $message = sprintf(

                "Nouvelle demande de rendez-vous :

                \n\nCivilité : %s

                \n\nNom : %s
                \nPrénom : %s

                \n\nTéléphone : %s
                \nAdresse e-mail : %s

                \n\nRue : %s
                \nVille : %s
                \nCode Postal : %s

                \n\nTransport : %s
                \nType : %s

                \n\nDate du rendez-vous : %s
                \nHeure du rendez-vous : %s
                \nDurée estimée du rendez-vous : %s

                \n\nLieu du rendez-vous : %s
                \nMédecin prescripteur : %s
                \nMotif du transport : %s
                \nType d'établissement : %s

                \n\nCommentaires : \n%s
                ",

                $sexe,

                $lastname,
                $firstname,

                $phone,
                $email,

                $street,
                $city,
                $postcode,

                $transport,
                $go,

                $date->format('d-m-Y'),
                $time->format('H:i'),
                $during->format('H:i'),
                
                $place,
                $prescripteur,
                $motif,
                $type,

                $content
            );
            
            

            $email = (new Email())
                ->from($email)
                ->to('admin@admin.com')
                ->subject('Demande de Rendez-vous')
                ->text($message);


            $mailer->send($email);

            // Ajout du message flash dans la session
            $this->addFlash('success', 'Votre demande de rendez-vous a été envoyé avec succès !');

            // Ajout d'un autre message flash dans la session
            $this->addFlash('info', 'Merci pour votre demande. Nous vous confirmerons ce rendez-vous dès que possible.');

            // Rediriger l'utilisateur après envoi du formulaire pour éviter de le renvoyer en actualisant la page (Post-Redirect-Get pattern)
            return $this->redirectToRoute('app_appointment');

        }
        return $this->render('main/appointment.html.twig', [
            'controller_name' => 'AppointmentController',
            'formulaire' => $form
        ]);
    }
}
