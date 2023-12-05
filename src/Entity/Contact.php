<?php

namespace App\Entity;

use App\Repository\ContactRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContactRepository::class)]
class Contact {

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 1)]
    #[Assert\NotBlank]
    #[Assert\Choice(['M', 'F'])]
    private ?string $titre = null;

    #[ORM\Column(length: 100)]
    private ?string $nom = null;

    #[ORM\Column(length: 100)]
    #[Assert\Email(
            message: "L'email {{ value }} n'est pas valide",
    )]
    private ?string $mail = null;

    #[Assert\Regex("/^[0][6-7](\s[0-9]{2}){4}")]
    #[ORM\Column(length: 15)]
    private ?string $tel = null;

    #[ORM\Column(name:'datepremiercontact', type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $datePremierContact = null;

    #[ORM\Column(length: 100)]
    private ?string $prenom = null;

    public function getId(): ?int {
        return $this->id;
    }

    public function getTitre(): ?string {
        return $this->titre;
    }

    public function setTitre(string $titre): static {
        $this->titre = $titre;

        return $this;
    }

    public function getNom(): ?string {
        return $this->nom;
    }

    public function setNom(string $nom): static {
        $this->nom = $nom;

        return $this;
    }

    public function getMail(): ?string {
        return $this->mail;
    }

    public function setMail(string $mail): static {
        $this->mail = $mail;

        return $this;
    }

    public function getTel(): ?string {
        return $this->tel;
    }

    public function setTel(string $tel): static {
        $this->tel = $tel;

        return $this;
    }

    public function getDatePremierContact(): ?\DateTimeInterface {
        return $this->datePremierContact;
    }

    public function setDatePremierContact(\DateTimeInterface $datePremierContact): static {
        $this->datePremierContact = $datePremierContact;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }
}
