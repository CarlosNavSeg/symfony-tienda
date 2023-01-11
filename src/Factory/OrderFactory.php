<?php

namespace App\Factory;

use App\Entity\Book;
use App\Entity\Order;
use App\Entity\OrderItem;

class OrderFactory
{
    /**
     * Creates an order.
     *
     * @return Order
     */
    public function create(): Order
    {
        $order = new Order();
        $order
            ->setStatus(Order::STATUS_CART)
        ;
        return $order;
    }

    /**
     * Creates an item for a product.
     *
     * @param Book $book
     *
     * @return OrderItem
     */
    public function createItem(Book $book): OrderItem
    {
        $item = new OrderItem();
        $item->addBook($book);
        $item->setQuantity(1);

        return $item;
    }
}