<?php

namespace App\Entity;

use App\Repository\OrderBookRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderBookRepository::class)
 */
class OrderBook
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0)
     */
    private $quantity;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $unit_price;

    /**
     * @ORM\ManyToOne(targetEntity=Order::class, inversedBy="orderBooks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $order_id;

    /**
     * @ORM\ManyToOne(targetEntity=Book::class, inversedBy="orderBooks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $book_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): ?string
    {
        return $this->quantity;
    }

    public function setQuantity(string $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getUnitPrice(): ?string
    {
        return $this->unit_price;
    }

    public function setUnitPrice(string $unit_price): self
    {
        $this->unit_price = $unit_price;

        return $this;
    }

    public function getOrderId(): ?Order
    {
        return $this->order_id;
    }

    public function setOrderId(?Order $order_id): self
    {
        $this->order_id = $order_id;

        return $this;
    }

    public function getBookId(): ?Book
    {
        return $this->book_id;
    }

    public function setBookId(?Book $book_id): self
    {
        $this->book_id = $book_id;

        return $this;
    }
}
