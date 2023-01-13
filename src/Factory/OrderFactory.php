<?php

namespace App\Factory;

use App\Entity\Book;
use App\Entity\Order;
use App\Entity\OrderItem;

/**
 * Class OrderFactory.
 */
class OrderFactory
{
    /**
     * Creates an order.
     */
    public function create(): Order
    {
        $order = new Order();
        $order
            ->setStatus(Order::STATUS_CART)
            ->setCreatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime());

        return $order;
    }

    /**
     * Creates an item for a product.
     */
    public function createItem(Book $product): OrderItem
    {
        $item = new OrderItem();
        $item->addBook($product);
        $item->setQuantity(1);

        return $item;
    }
}