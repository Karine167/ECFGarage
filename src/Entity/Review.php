<?php

namespace App\Entity;

use App\Repository\ReviewRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ReviewRepository::class)]
class Review
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Assert\Length(min: 2, max: 50, minMessage: 'Le nom d\'utilisateur doit comporter au moins deux caractères.', maxMessage: 'Le nom d\'utilisateur ne doit pas comporter plus de 50 caractères.')]
    #[Assert\NotBlank(message:'Le nom d\'utilisateur ne doit pas être vide.')]
    private ?string $username = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message:'Le commentaire ne doit pas être vide.')]
    private ?string $content = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $rate = 1;

    #[ORM\Column]
    private ?bool $approved = false;

    #[ORM\ManyToOne(inversedBy: 'reviews')]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

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

    public function getRate(): ?int
    {
        return $this->rate;
    }

    public function setRate(int $rate): static
    {
        $this->rate = $rate;

        return $this;
    }

    public function isApproved(): ?bool
    {
        return $this->approved;
    }

    public function setApproved(bool $approved): static
    {
        $this->approved = $approved;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }
}
