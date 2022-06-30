<?php

declare(strict_types=1);

namespace App\UseCase;

use App\OrderItem\OrderItem;
use App\Entity\Order;
use App\Repository\OrderRepository;

class CreateOrder
{

    public function __construct(
        private OrderRepository $orderRepository
    ) {
    }

    public function execute(CreateOrderModel $orderModel): ?string
    {
        $order = new Order();
        $order->setClientEmail($orderModel->getClientEmail());
        $order->setTotalSum($orderModel->getTotalSum());
        $order->setQuantity(1);
        $order->setStatus('PENDING');
        $this->orderRepository->save($order);

        return $order->getUuid()->toString();
    }
}