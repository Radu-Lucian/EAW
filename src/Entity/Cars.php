<?php

namespace App\Entity;

use App\Repository\CarsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CarsRepository::class)
 */
class Cars
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $make;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $model;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class)
     */
    private $FK_car_user_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMake(): ?string
    {
        return $this->make;
    }

    public function setMake(string $make): self
    {
        $this->make = $make;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getFKCarUserId(): ?users
    {
        return $this->FK_car_user_id;
    }

    public function setFKCarUserId(?users $FK_car_user_id): self
    {
        $this->FK_car_user_id = $FK_car_user_id;

        return $this;
    }

    public function __toString() {
        return $this->id.' '.$this->make.' '.$this->model;
    }
}
