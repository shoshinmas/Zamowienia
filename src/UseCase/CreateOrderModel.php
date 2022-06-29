<?php

declare(strict_types=1);

namespace App\UseCase;

use Symfony\Component\HttpFoundation\Request;

class CreateOrderModel
{

    public function __construct(
        private readonly int $quantity,
        private readonly string $title,
        private readonly int $totalSum,
    ) {
    }

    public static function fromRequest(Request $request): self
    {

        $data['clientEmail'] = $request->get('clientEmail');
        $data['quantity'] = (int)($request->get('product_id'));
        $data['totalSum'] = (int)($request->get('product_price'));
        return new self(
            $data['quantity'],
            $data['clientEmail'],
            $data['totalSum']
        );
    }
}