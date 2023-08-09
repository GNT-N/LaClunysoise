<?php

namespace App\Controller;

use App\Form\AppointmentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

// Définition de la classe AppointmentController qui hérite de AbstractController
class AppointmentController extends AbstractController
{
    // Définition de la route '/vos-rendez-vous' avec le nom 'app_appointment'
    #[Route('/vos-rendez-vous', name: 'app_appointment')]
    public function index(Request $request, MailerInterface $mailer): Response
    {
        // Création du formulaire à partir de la classe AppointmentType
        $form = $this->createForm(AppointmentType::class);

        // Gestion de la requête HTTP avec le formulaire
        $form->handleRequest($request);

        // Vérification si le formulaire a été soumis et est valide
        if ($form->isSubmitted() && $form->isValid()) {

            // Récupération des données du formulaire
            $data = $form->getData();
            // Extraction des données du formulaire dans des variables
            $gender = $data['Civilite'];
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

            // Conversion des valeurs de date et heure en objets DateTimeImmutable
            $date = new \DateTimeImmutable($data['DateRendezVous']->format('Y-m-d'));
            $during = new \DateTimeImmutable($data['DureeEstimee']->format('H:i'));
            $time = new \DateTimeImmutable($data['HeureRendezVous']->format('H:i'));

            // Vérification si l'heure du rendez-vous est en dehors de la plage horaire autorisée (6h à 20h)
            $startHour = new \DateTimeImmutable('06:00');
            $endHour = new \DateTimeImmutable('20:00');
            if ($time < $startHour || $time > $endHour) {
                if ($time < $startHour || $time > $endHour) {
                    // Heure de rendez-vous en dehors de la plage horaire autorisée, afficher un message d'erreur
                    $this->addFlash('error', 'Les rendez-vous ne sont autorisés qu\'entre 6h et 20h.');
                    // Redirige l'utilisateur vers la page de prise de rendez-vous
                    return $this->redirectToRoute('app_appointment');
                }

                // Vérifie si les champs du formulaire sont vides ou nuls
                if ((empty($email) && is_null($email)) || (empty($content) && is_null($content)) || (empty($date) && is_null($date))) {
                    // Si l'un des champs est vide ou nul, ajoute un message d'erreur
                    $this->addFlash('danger', 'Les champs du formulaire sont obligatoires.');
                    // Redirige l'utilisateur vers la page de prise de rendez-vous
                    return $this->redirectToRoute('app_appointment');
                }
                $this->addFlash('error', 'Les rendez-vous ne sont autorisés qu\'entre 6h et 20h.');
                return $this->redirectToRoute('app_appointment');
            }

            // sprintf retourne une chaîne de caractères formatée
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

                $gender,

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

            // Création de l'e-mail avec le message
            $email = (new Email())
                ->from($email)
                ->to('admin@admin.com')
                ->subject('Demande de Rendez-vous')
                ->text($message);

            // Envoi de l'e-mail avec le service MailerInterface
            $mailer->send($email);

            // Ajout de messages flash dans la session
            $this->addFlash('success', 'Votre demande de rendez-vous a été envoyé avec succès !');
            $this->addFlash('info', 'Merci pour votre demande. Nous vous confirmerons ce rendez-vous dès que possible.');

            // Redirection de l'utilisateur après envoi du formulaire pour éviter de le renvoyer en actualisant la page (Post-Redirect-Get pattern)
            return $this->redirectToRoute('app_appointment');

        }
        // Rendu du template 'main/appointment.html.twig' avec le formulaire
        return $this->render('main/appointment.html.twig', [
            'controller_name' => 'AppointmentController',
            'formulaire' => $form
        ]);
    }
}