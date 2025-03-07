<?php

namespace App\Entity;

use App\Enum\GearboxChoice;
use App\Repository\VoitureRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: VoitureRepository::class)]
class Voiture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    // #[Assert\Length(min: 2, max: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?float $monthlyPrice = null;

    #[ORM\Column]
    private ?float $dailyPrice = null;

    #[ORM\Column]
    private ?int $nbOfPlaces = null;

    #[ORM\Column(length: 255)]
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
