<?php

namespace App\Entity;

use App\Repository\UserTicketsMechanicsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserTicketsMechanicsRepository::class)
 */
class UserTicketsMechanics
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=UserTickets::class)
     */
    private $FK_user_ticket_id;

    /**
     * @ORM\ManyToOne(targetEntity=Mechanics::class)
     */
    private $FK_mechanic_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFKUserTicketId(): ?usertickets
    {
        return $this->FK_user_ticket_id;
    }

    public function setFKUserTicketId(?usertickets $FK_user_ticket_id): self
    {
        $this->FK_user_ticket_id = $FK_user_ticket_id;

        return $this;
    }

    public function getFKMechanicId(): ?mechanics
    {
        return $this->FK_mechanic_id;
    }

    public function setFKMechanicId(?mechanics $FK_mechanic_id): self
    {
        $this->FK_mechanic_id = $FK_mechanic_id;

        return $this;
    }
}
