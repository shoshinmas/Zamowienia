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

    public function execute(CreateOrderModel $orderModel): ?int
    {
        $order = new Order();
        $order->setClientEmail($orderModel->getClientEmail());
        $order->setTotalSum($orderModel->getTotalSum());
        $order->setQuantity(5);
        $order->setStatus('PENDING');
        $this->orderRepository->save($order);

        return $order->getId();
    }
}