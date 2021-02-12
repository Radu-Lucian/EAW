<?php

namespace App\Entity;

use App\Repository\TalonsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TalonsRepository::class)
 */
class Talons
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $registration_plate;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $vin;

    /**
     * @ORM\Column(type="decimal", precision=7, scale=4)
     */
    private $cc;

    /**
     * @ORM\Column(type="datetime")
     */
    private $registartion_year;

    /**
     * @ORM\Column(type="datetime")
     */
    private $expiration_date;

    /**
     * @ORM\OneToOne(targetEntity=Cars::class, cascade={"persist", "remove"})
     */
    private $FK_talon_car_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRegistrationPlate(): ?string
    {
        return $this->registration_plate;
    }

    public function setRegistrationPlate(string $registration_plate): self
    {
        $this->registration_plate = $registration_plate;

        return $this;
    }

    public function getVin(): ?string
    {
        return $this->vin;
    }

    public function setVin(string $vin): self
    {
        $this->vin = $vin;

        return $this;
    }

    public function getCc(): ?string
    {
        return $this->cc;
    }

    public function setCc(string $cc): self
    {
        $this->cc = $cc;

        return $this;
    }

    public function getRegistartionYear(): ?\DateTimeInterface
    {
        return $this->registartion_year;
    }

    public function setRegistartionYear(\DateTimeInterface $registartion_year): self
    {
        $this->registartion_year = $registartion_year;

        return $this;
    }

    public function getExpirationDate(): ?\DateTimeInterface
    {
        return $this->expiration_date;
    }

    public function setExpirationDate(\DateTimeInterface $expiration_date): self
    {
        $this->expiration_date = $expiration_date;

        return $this;
    }

    public function getFKTalonCarId(): ?cars
    {
        return $this->FK_talon_car_id;
    }

    public function setFKTalonCarId(cars $FK_talon_car_id): self
    {
        $this->FK_talon_car_id = $FK_talon_car_id;

        return $this;
    }
}
