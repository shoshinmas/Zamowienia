<?php

declare(strict_types=1);

namespace App\UseCase;

use App\Entity\Order;
use App\Repository\OrderRepository;

class CreateOrder
{

    public function __construct(
        private OrderRepository $orderRepository
    ) {
    }

    public function execute(CreateOrderModel $order): ?int
    {
        $order = new Order();

        $this->orderRepository->save($order);

        return $order->getId();
    }
}