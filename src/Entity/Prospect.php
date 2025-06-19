<?php

namespace App\Entity;

use App\Repository\ProspectRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: ProspectRepository::class)]
class Prospect
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length(min: 3, max: 50, minMessage: 'Le nom n\'est pas valide.', maxMessage: 'Le nom n\'est pas valide.')]
    #[Assert\NotBlank( message: 'Ce champ est obligatoire.')]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length(min: 3, max: 50, minMessage: 'Le prenom n\'est pas valide.', maxMessage: 'Le prenom n\'est pas valide.')]
    #[Assert\NotBlank( message: 'Ce champ est obligatoire.')]
    private ?string $surname = null;

    #[ORM\Column(length: 255)]
    #[Assert\Regex( pattern: '/(?:\+33|0)[\s-]?[1-9](?:[\s-]?\d{2}){4}/', message: 'Le numéro de téléphone n\'est pas valide.')]
    private ?string $phone = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank( message: 'Ce champ est obligatoire.')]
    #[Assert\Email( message: '{{ value }} n\'est pas un email valide.')]
    private ?string $email = null;

    #[Assert\NotBlank( message: 'Ce champ est obligatoire.')]
    #[Assert\Length(min: 10, minMessage: 'Votre message doit faire au moins {{ limit }} caractères.')]
    #[ORM\Column(type: Types::TEXT, length: 2000)]
    private ?string $message = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): static
    {
        $this->surname = $surname;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): static
    {
        $this->phone = $phone;

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

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): static
    {
        $this->message = $message;

        return $this;
    }
}
