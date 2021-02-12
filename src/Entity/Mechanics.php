<?php

namespace App\Entity;

use App\Repository\MechanicsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MechanicsRepository::class)
 */
class Mechanics
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
    private $specialization;

    /**
     * @ORM\OneToOne(targetEntity=Users::class, cascade={"persist", "remove"})
     */
    private $FK_mechanic_user_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSpecialization(): ?string
    {
        return $this->specialization;
    }

    public function setSpecialization(string $specialization): self
    {
        $this->specialization = $specialization;

        return $this;
    }

    public function getFKMechanicUserId(): ?users
    {
        return $this->FK_mechanic_user_id;
    }

    public function setFKMechanicUserId(users $FK_mechanic_user_id): self
    {
        $this->FK_mechanic_user_id = $FK_mechanic_user_id;

        return $this;
    }

    public function __toString() {
        return $this->specialization.' '.$this->FK_mechanic_user_id;
    }
}
