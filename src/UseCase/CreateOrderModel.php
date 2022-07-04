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
        private array $id,
        private string $clientEmail,
        private array $quantity,
        private array $price,
        private int $totalSum
    ) {
    }


    public static function fromRequest(Request $request, UuidInterface $orderUuid): self
    {
//        $pName = $request->request->get('product_name');
//        $id = $request->request->get('product_id');
//        $quantity = $request->request->get('product_quantity');
//        $price = $request->request->get('product_price');
        $requestedArrayLength = count($request->request->getIterator()) - 3;
        $requestedArray = $request->request->getIterator();
        for ($i=1; $i<= $requestedArrayLength; $i++)
        {

        }
        dd($requestedArray);


        //$mapped = array_map(function($quantity, $price) { return $quantity * $price;}, $quantity, $price);

        $totalSum = 0;
        //foreach($mapped as $sum) { $totalSum += $sum;}
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