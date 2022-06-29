<?php

declare(strict_types=1);

namespace App\UseCase;

use Symfony\Component\HttpFoundation\Request;

class CreateOrderModel
{

    public function __construct(
        private string $clientEmail,
        private $totalSum
    ) {
    }

    public static function fromRequest(Request $request): self
    {
        $quantity = $_POST['product_id'];
        $price = $_POST['product_price'];
        $mapped = array_map(function($quantity, $price) { return $quantity * $price;}, $quantity, $price);

        $totalSum = 0;
        foreach($mapped as $sum) { $totalSum += $sum;}
        $clientEmail = $request->get('clientEmail');

        return new self(
            $clientEmail,
            $totalSum
        );
    }
}