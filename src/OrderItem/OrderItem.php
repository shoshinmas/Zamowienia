<?php

namespace App\OrderItem;

use App\Entity\Order;

class OrderItem
{
    public function __construct(
        private int $externalId,
        private string $title,
        private int $price,
        private int $quantity = 1,
    ) {
    }

    public function increaseQuantity(): void
    {
        $this->quantity++;
    }

    public function getExternalId(): int
    {
        return $this->externalId;
    }


    public function isSame(OrderItem $item): bool
    {
        return ($this->externalId === $item->getExternalId());
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function getTitle(): string
    {
        return $this->title;
    }
}