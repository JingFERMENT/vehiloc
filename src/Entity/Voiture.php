<?php

namespace App\Entity;

use App\Validator\BannedWords;
use App\Enum\GearboxChoice;
use App\Repository\VoitureRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: VoitureRepository::class)]
#[UniqueEntity(fields: ['name'], message: "Ce nom de voiture est déjà utilisé")]

class Voiture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(min: 2, max: 255)]
    #[Assert\Regex(pattern: "/^[a-zA-Z0-9 ]+$/", message: "Le nom de la voiture ne doit contenir que des lettres, des chiffres et des espaces")]
    #[BannedWords]// Apply the custom validation
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank]
    private ?string $description = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    #[Assert\Positive(message: "Le prix mensuel doit être positif")]
    #[Assert\GreaterThanOrEqual(propertyPath: "dailyPrice", message: "Le prix mensuel doit être supérieur ou égal au prix journalier")]
    private ?float $monthlyPrice = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    #[Assert\Positive(message: "Le prix mensuel doit être positif")]
    #[Assert\LessThanOrEqual(value: 100, message: "Le prix journalier doit être inférieur ou égal au 100€.")]
    private ?float $dailyPrice = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    #[Assert\Range(min: 1, max: 9)]
    private ?int $nbOfPlaces = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?GearboxChoice $gearbox = null;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getMonthlyPrice(): ?float
    {
        return $this->monthlyPrice;
    }

    public function setMonthlyPrice(float $monthlyPrice): static
    {
        $this->monthlyPrice = $monthlyPrice;

        return $this;
    }

    public function getDailyPrice(): ?float
    {
        return $this->dailyPrice;
    }

    public function setDailyPrice(float $dailyPrice): static
    {
        $this->dailyPrice = $dailyPrice;

        return $this;
    }

    public function getNbOfPlaces(): ?int
    {
        return $this->nbOfPlaces;
    }

    public function setNbOfPlaces(int $nbOfPlaces): static
    {
        $this->nbOfPlaces = $nbOfPlaces;

        return $this;
    }

    public function getGearbox(): ?GearboxChoice
    {
        return $this->gearbox;
    }

    public function setGearbox(GearboxChoice $gearbox): static
    {
        $this->gearbox = $gearbox;

        return $this;
    }
}
