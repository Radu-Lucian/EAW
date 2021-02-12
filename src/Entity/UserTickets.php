<?php

namespace App\Entity;

use App\Repository\UserTicketsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserTicketsRepository::class)
 */
class UserTickets
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=300)
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_started;

    /**
     * @ORM\ManyToOne(targetEntity=Cars::class)
     */
    private $FK_user_ticket_car_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDateStarted(): ?\DateTimeInterface
    {
        return $this->date_started;
    }

    public function setDateStarted(\DateTimeInterface $date_started): self
    {
        $this->date_started = $date_started;

        return $this;
    }

    public function getFKUserTicketCarId(): ?cars
    {
        return $this->FK_user_ticket_car_id;
    }

    public function setFKUserTicketCarId(?cars $FK_user_ticket_car_id): self
    {
        $this->FK_user_ticket_car_id = $FK_user_ticket_car_id;

        return $this;
    }

    public function __toString() {
        return $this->description;
    }

}
