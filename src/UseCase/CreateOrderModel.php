<?php

declare(strict_types=1);

namespace App\UseCase;

use Symfony\Component\HttpFoundation\Request;

class CreateOrderModel
{

    public function __construct(
        private string $orderUuid,
        private array $id,
        private string $clientEmail,
        private array $quantity,
        private array $price,
        private int $totalSum
    ) {
    }


    public static function fromRequest(Request $request, string $orderUuid): self
    {
        $id = $_POST['product_id'];
        $quantity = $_POST['product_quantity'];
        $price = $_POST['product_price'];
        $mapped = array_map(function($quantity, $price) { return $quantity * $price;}, $quantity, $price);

        $totalSum = 0;
        foreach($mapped as $sum) { $totalSum += $sum;}
        $clientEmail = $request->get('clientEmail');

        return new self(
            $orderUuid,
            $id,
            $clientEmail,
            $price,
            $quantity,
            $totalSum
        );
    }

    public function getId(): array
    {
        return $this->id;
    }

    public function getClientEmail(): string
    {
        return $this->clientEmail;
    }

    public function getQuantity(): array
    {
        return $this->quantity;
    }

    public function getPrice(): array
    {
        return $this->price;
    }

    public function getTotalSum(): int
    {
        return $this->totalSum;
    }

    public function getOrderUuid(): string
    {
        return $this->orderUuid;
    }
}