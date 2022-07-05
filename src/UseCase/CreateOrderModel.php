<?php

declare(strict_types=1);

namespace App\UseCase;

use App\OrderItem\OrderItem;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\HttpFoundation\Request;
use function Symfony\Component\DependencyInjection\Loader\Configurator\param;

class CreateOrderModel
{

    public function __construct(
        private UuidInterface $orderUuid,
        private string $clientEmail,
        array $items,
        private int $totalSum
    ) {
    }


    public static function fromRequest(Request $request, UuidInterface $orderUuid): self
    {
        $totalSum = 1;
        $items = [];
        $products = $request->request->all()['orderData'];
        foreach($products as $product)
        {
            if((int)($product['quantity'])>0) {
                $orderItems = new OrderItem(
                    $orderUuid,
                    $product['name'],
                    (int)$product['price'],
                    (int)$product['quantity']);
                $totalSum += $orderItems->getGeneralAmount();
                $items[] = $orderItems;
            }
        };

        $clientEmail = $request->get('clientEmail');

        return new self(
            $orderUuid,
            $clientEmail,
            $items,
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