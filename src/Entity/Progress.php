<?php

namespace App\Entity;

use App\Repository\ProgressRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProgressRepository::class)
 */
class Progress
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $state;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $estimation_date;

    /**
     * @ORM\ManyToOne(targetEntity=UserTickets::class)
     */
    private $FK_progress_user_ticket_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(?string $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getEstimationDate(): ?\DateTimeInterface
    {
        return $this->estimation_date;
    }

    public function setEstimationDate(?\DateTimeInterface $estimation_date): self
    {
        $this->estimation_date = $estimation_date;

        return $this;
    }

    public function getFKProgressUserTicketId(): ?usertickets
    {
        return $this->FK_progress_user_ticket_id;
    }

    public function setFKProgressUserTicketId(?usertickets $FK_progress_user_ticket_id): self
    {
        $this->FK_progress_user_ticket_id = $FK_progress_user_ticket_id;

        return $this;
    }

    public function __toString() {
        return $this->state;
    }
}
