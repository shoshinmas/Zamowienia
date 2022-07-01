<?php

declare(strict_types=1);

namespace App\UseCase;

use App\OrderItem\OrderItem;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\HttpFoundation\Request;

class CreateOrderModel
{

    public function __construct(
        private UuidInterface $orderUuid,
        private array $id,
        private string $clientEmail,
        private array $quantity,
        private array $price,
        private int $totalSum
    ) {
    }


    public static function fromRequest(Request $request, UuidInterface $orderUuid): self
    {
        $pName = $_POST['product_name'];
        $id = $_POST['product_id'];
        $quantity = $_POST['product_quantity'];
        $price = $_POST['product_price'];
        $orderItem = new OrderItem(externalId: $orderUuid, title: $pName, price: $price,quantity: $quantity);
        var_dump($orderItem);
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

    public function getOrderUuid(): UuidInterface
    {
        return $this->orderUuid;
    }
}