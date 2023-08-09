<?php

// Définition de l'espace de noms
namespace App\Entity;

// Importation des classes nécessaires
use App\Repository\PostRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

// Annotation pour indiquer que cette classe est une entité et spécifier le repository associé
#[ORM\Entity(repositoryClass: PostRepository::class)]
class Post
{
    // ID comme clé primaire, générée automatiquement, et colonne de la table
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    // Annotation pour définir une colonne avec une longueur maximale de 255 caractères
    #[ORM\Column(length: 255)]
    private ?string $title = null;

    // Annotation pour définir une colonne de type texte
    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    // Annotation pour définir une colonne de type texte qui peut être nulle
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    // Annotation pour définir une colonne qui peut être nulle avec une longueur maximale de 255 caractères
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $mediaUrl = null;

    // Annotation pour définir une colonne de type date et heure
    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    // Annotation pour définir une colonne de type date et heure qui peut être nulle
    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    // Annotation pour définir une colonne avec une longueur maximale de 255 caractères
    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    // Annotation pour définir une colonne de type booléen
    #[ORM\Column]
    private ?bool $visible = true;

    // Annotation pour définir une colonne avec une longueur maximale de 255 caractères
    #[ORM\Column(length: 255)]
    private ?string $page = null;

    // Les méthodes suivantes sont des getters et des setters pour chaque propriété de l'entité
    // Ils permettent d'accéder et de modifier les valeurs de ces propriétés
    // Chaque setter retourne l'instance de l'objet pour permettre le chaînage des appels de méthodes

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getMediaUrl(): ?string
    {
        return $this->mediaUrl;
    }

    public function setMediaUrl(?string $mediaUrl): static
    {
        $this->mediaUrl = $mediaUrl;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    public function isVisible(): ?bool
    {
        return $this->visible;
    }

    public function setVisible(bool $visible): static
    {
        $this->visible = $visible;

        return $this;
    }

    public function getPage(): ?string
    {
        return $this->page;
    }

    public function setPage(string $page): static
    {
        $this->page = $page;

        return $this;
    }
}
