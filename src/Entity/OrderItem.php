<?php

namespace App\Entity;

use App\Repository\OrderItemRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderItemRepository::class)]
class OrderItem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'orderedItem', targetEntity: Book::class)]
    private Collection $book;

    
    #[ORM\ManyToOne(targetEntity: "Order", inversedBy: "orderItems")]
    #[ORM\JoinColumn(nullable: false)]
    private $orderRef;

    #[ORM\Column]
    private ?int $quantity = null;

    #[ORM\ManyToOne(inversedBy: 'orderItems')]
    private ?Order $orderItems = null;

    public function __construct()
    {
        $this->book = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Book>
     */
    public function getBook(): Collection
    {
        return $this->book;
    }

    public function addBook(Book $book): self
    {
        if (!$this->book->contains($book)) {
            $this->book->add($book);
            $book->setOrderedItem($this);
        }

        return $this;
    }

    public function removeBook(Book $book): self
    {
        if ($this->book->removeElement($book)) {
            // set the owning side to null (unless already changed)
            if ($book->getOrderedItem() === $this) {
                $book->setOrderedItem(null);
            }
        }

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getOrderItems(): ?Order
    {
        return $this->orderItems;
    }

    public function setOrderItems(?Order $orderItems): self
    {
        $this->orderItems = $orderItems;

        return $this;
    }
    public function equals(OrderItem $item): bool
    {
    return $this->getOrderItems()->getId() === $item->getOrderItems()->getId();
    }

    public function getOrderRef(): ?Order
    {
        return $this->orderRef;
    }

    public function setOrderRef(?Order $orderRef): self
    {
        $this->orderRef = $orderRef;

        return $this;
    }

    public function getTotal(): float
    {
    return $this->getBook()->getPrice() * $this->getQuantity();
    }
}
