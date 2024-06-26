<?php

namespace App\Entity;

use App\Repository\ContactRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ContactRepository::class)]
class Contact
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Assert\Length(min: 2, max: 50, minMessage: 'Le prénom doit comporter au moins deux caractères.', maxMessage: 'Le prénom ne doit pas comporter plus de 50 caractères.')]
    #[Assert\NotBlank(message:'Le prénom ne doit pas être vide.')]
    private ?string $first_name = null;

    #[ORM\Column(length: 50)]
    #[Assert\Length(min: 2, max: 50, minMessage: 'Le nom doit comporter au moins deux caractères.', maxMessage: 'Le nom ne doit pas comporter plus de 50 caractères.')]
    #[Assert\NotBlank(message:'Le nom ne doit pas être vide.')]
    private ?string $last_name = null;

    #[ORM\Column(length: 255)]
    #[Assert\Email(message: 'cette adresse email n\'est pas valide.' )]
    #[Assert\NotBlank(message:'L\'email ne doit pas être vide.')]
    #[Assert\Length(min: 2, max: 180, minMessage: 'L\'email doit comporter au moins deux caractères.', maxMessage: 'L\'email ne doit pas comporter plus de 180 caractères.')]
    private ?string $email = null;

    #[ORM\Column(length: 20)]
    #[Assert\NotBlank(message:'Le numéro de téléphone ne doit pas être vide.')]
    #[Assert\Length(min: 2, max: 20, minMessage:'Le numéro de téléphone doit comporter au moins deux chiffres.', maxMessage: 'Le numéro de téléphone ne doit pas comporter plus de 20 chiffres.' )]
    #[Assert\Regex("/^[0-9]{10}$/", message:'Le numéro de téléphone doit être composé de 10 chiffres.')]
    private ?string $telephon = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message:'Le corps du message ne doit pas être vide.')]
    private ?string $content = null;

    #[ORM\Column]
    private ?bool $acceptance = true;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $comment = null;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'contacts')]
    private Collection $user;

    public function __construct()
    {
        $this->user = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): static
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): static
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getTelephon(): ?string
    {
        return $this->telephon;
    }

    public function setTelephon(string $telephon): static
    {
        $this->telephon = $telephon;

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

    public function isAcceptance(): ?bool
    {
        return $this->acceptance;
    }

    public function setAcceptance(bool $acceptance): static
    {
        $this->acceptance = $acceptance;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): static
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(User $user): static
    {
        if (!$this->user->contains($user)) {
            $this->user->add($user);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        $this->user->removeElement($user);

        return $this;
    }
}
