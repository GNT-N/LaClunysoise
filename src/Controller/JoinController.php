<?php

namespace App\Controller;

// Importer les classes nécessaires
use App\Form\JoinType;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mime\Part\DataPart;
use Symfony\Component\Mime\Part\File;

// Définir la classe du contrôleur
class JoinController extends AbstractController
{
    // Déclarer une propriété pour l'EntityManager
    private $entityManager;

    // Le constructeur permet d'injecter l'EntityManager dans le contrôleur
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    // Définir la première action du contrôleur avec l'annotation de route
    #[Route('/join', name: 'app_join')]
    public function index(Request $request, MailerInterface $mailer, PostRepository $postRepository): Response
    {
        // Créer le formulaire en utilisant JoinType qui doit être défini dans "App\Form"
        $form = $this->createForm(JoinType::class);

        // Gérer la soumission du formulaire
        $form->handleRequest($request);

        // Vérifier si le formulaire est soumis et valide
        if ($form->isSubmitted() && $form->isValid()) {
            // Récupérer les données du formulaire
            $data = $form->getData();
            $sexe = $data['Civilite'];
            $lastname = $data['Nom'];
            $firstname = $data['Prenom'];
            $phone = $data['Telephone'];
            $email = $data['email'];
            $file = $data['Fichier'];
            $content = $data['content'];

            $message = sprintf(

                "Nouveau Candidat(e) ,\n\nCivilité: %s\n\nNom: %s\nPrénom: %s\n\nTéléphone: %s\nAdresse e-mail: %s\n\nCv: %s\n\nCommentaires: \n%s",

                $sexe,
                $lastname,
                $firstname,
                $phone,
                $email,
                $file,
                $content
            );

            // Vérifier si le champ "Fichier" est null
            if ($file === null) {
                // Créer un nouvel e-mail sans le fichier
                $email = (new Email())
                    ->from($email)
                    ->to('admin@admin.com')
                    ->subject('Candidature')
                    ->text($message);
            } else {
                // Le champ "Fichier" est spécifié, créer une instance de File
                $fileObject = new File($file);

                // Créer un nouvel e-mail avec le fichier
                $email = (new Email())
                    ->from($email)
                    ->to('admin@admin.com')
                    ->subject('Candidature')
                    ->addPart(new DataPart($fileObject, 'Contract', 'application/msword'))
                    ->text($message);
            }

            // Envoyer l'e-mail en utilisant le service de messagerie (MailerInterface)
            $mailer->send($email);

            // Ajout du message flash dans la session
            $this->addFlash('success', 'Votre Candidature a été envoyé avec succès !');

            // Rediriger l'utilisateur après envoi du formulaire pour éviter de le renvoyer en actualisant la page (Post-Redirect-Get pattern)
            return $this->redirectToRoute('app_join');
        }

        // Appel de la fonction join avec les posts filtrés par page et visibilité
        $posts = $postRepository->findBy(array('page' => 'nous-rejoindre', 'visible' => true));

        // Rendre le template 'main/joinUs.html.twig' avec les variables à passer au template
        return $this->render('main/joinUs.html.twig', [
            'controller_name' => 'JoinController', // Variable pour afficher le nom du contrôleur dans le template (utilisation optionnelle)
            'formulaire' => $form->createView(), // Utilisez createView() pour obtenir la vue du formulaire
            'post' => $posts, // Variable contenant les posts filtrés par page et visibilité
        ]);
    }
}