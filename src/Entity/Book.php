<?php

namespace App\Entity;

use App\Repository\BookRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BookRepository::class)
 */
class Book
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $price;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $featured_image;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="books")
     */
    private $category_id;

    /**
     * @ORM\OneToMany(targetEntity=OrderBook::class, mappedBy="book_id")
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

    public function setPrice(?string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getFeaturedImage(): ?string
    {
        return $this->featured_image;
    }

    public function setFeaturedImage(?string $featured_image): self
    {
        $this->featured_image = $featured_image;

        return $this;
    }

    public function getCategoryId(): ?Category
    {
        return $this->category_id;
    }

    public function setCategoryId(?Category $category_id): self
    {
        $this->category_id = $category_id;

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
            $orderBook->setBookId($this);
        }

        return $this;
    }

    public function removeOrderBook(OrderBook $orderBook): self
    {
        if ($this->orderBooks->removeElement($orderBook)) {
            // set the owning side to null (unless already changed)
            if ($orderBook->getBookId() === $this) {
                $orderBook->setBookId(null);
            }
        }

        return $this;
    }
}
