<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    const STATUS_CART = 'cart';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $orderPrice = null;

    #[ORM\Column(length: 255)]
    private ?string $status = self::STATUS_CART;

    #[ORM\OneToMany(mappedBy: 'orderItems', targetEntity: OrderItem::class)]
    private Collection $orderItems;

    public function __construct()
    {
        $this->orderItems = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getOrderPrice(): ?float
    {
        return $this->orderPrice;
    }

    public function setOrderPrice(float $orderPrice): self
    {
        $this->orderPrice = $orderPrice;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection<int, OrderItem>
     */
    public function getOrderItems(): Collection
    {
        return $this->orderItems;
    }

    public function addItem(OrderItem $item): self
    {
    foreach ($this->getOrderItems() as $existingItem) {
        // The item already exists, update the quantity
        if ($existingItem->equals($item)) {
            $existingItem->setQuantity(
                $existingItem->getQuantity() + $item->getQuantity()
            );
            return $this;
        }
    }

    $this->orderItems[] = $item;
    $item->setOrderRef($this);

    return $this;
    }

    public function removeItems(): self
    {
    foreach ($this->getOrderItems() as $item) {
        $this->removeBook($item);
    }

    return $this;
    }

    public function getTotal(): float
    {
    $total = 0;

    foreach ($this->getOrderItems() as $item) {
        $total += $item->getTotal();
    }

    return $total;
    }
}

