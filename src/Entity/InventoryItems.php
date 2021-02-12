<?php

namespace App\Entity;

use App\Repository\InventoryItemsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InventoryItemsRepository::class)
 */
class InventoryItems
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
    private $name;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="decimal", precision=7, scale=2)
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $serial_number;

    /**
     * @ORM\ManyToOne(targetEntity=UserTickets::class)
     */
    private $FK_inventory_item_user_ticket_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getSerialNumber(): ?string
    {
        return $this->serial_number;
    }

    public function setSerialNumber(string $serial_number): self
    {
        $this->serial_number = $serial_number;

        return $this;
    }

    public function getFKInventoryItemUserTicketId(): ?usertickets
    {
        return $this->FK_inventory_item_user_ticket_id;
    }

    public function setFKInventoryItemUserTicketId(?usertickets $FK_inventory_item_user_ticket_id): self
    {
        $this->FK_inventory_item_user_ticket_id = $FK_inventory_item_user_ticket_id;

        return $this;
    }
}
