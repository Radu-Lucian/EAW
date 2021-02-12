<?php

namespace App\Entity;

use App\Repository\NotesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NotesRepository::class)
 */
class Notes
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=300, nullable=true)
     */
    private $message;

    /**
     * @ORM\ManyToOne(targetEntity=Progress::class)
     */
    private $FK_note_progress_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getFKNoteProgressId(): ?progress
    {
        return $this->FK_note_progress_id;
    }

    public function setFKNoteProgressId(?progress $FK_note_progress_id): self
    {
        $this->FK_note_progress_id = $FK_note_progress_id;

        return $this;
    }
}
