<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderRepository::class)
 * @ORM\Table(name="`order`")
 */
class Order
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $billing_address;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $amount;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $discount;

    /**
     * @ORM\OneToMany(targetEntity=OrderBook::class, mappedBy="order_id", orphanRemoval=true)
     */
    private $orderBooks;

    public function __construct()
    {
        $this->orderBooks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBillingAddress(): ?string
    {
        return $this->billing_address;
    }

    public function setBillingAddress(string $billing_address): self
    {
        $this->billing_address = $billing_address;

        return $this;
    }

    public function getAmount(): ?string
    {
        return $this->amount;
    }

    public function setAmount(string $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getDiscount(): ?string
    {
        return $this->discount;
    }

    public function setDiscount(?string $discount): self
    {
        $this->discount = $discount;

        return $this;
    }

    /**
     * @return Collection|OrderBook[]
     */
    public function getOrderBooks(): Collection
    {
        return $this->orderBooks;
    }

    public function addOrderBook(OrderBook $orderBook): self
    {
        if (!$this->orderBooks->contains($orderBook)) {
            $this->orderBooks[] = $orderBook;
            $orderBook->setOrderId($this);
        }

        return $this;
    }

    public function removeOrderBook(OrderBook $orderBook): self
    {
        if ($this->orderBooks->removeElement($orderBook)) {
            // set the owning side to null (unless already changed)
            if ($orderBook->getOrderId() === $this) {
                $orderBook->setOrderId(null);
            }
        }

        return $this;
    }
}
