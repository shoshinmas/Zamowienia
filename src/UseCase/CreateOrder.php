<?php

declare(strict_types=1);

namespace App\UseCase;

use App\OrderItem\OrderItem;
use App\Entity\Order;
use App\Repository\OrderRepository;
use Ramsey\Uuid\UuidInterface;

class CreateOrder
{

    public function __construct(
        private OrderRepository $orderRepository
    ) {
    }

    public function execute(CreateOrderModel $orderModel, UuidInterface $uuid): ?string
    {
        $order = new Order();
        $order->setUuId($uuid);
        $order->setClientEmail($orderModel->getClientEmail());
        $order->setTotalSum($orderModel->getTotalSum());
        $order->setQuantity(1);
        $order->setStatus('PENDING');
        $this->orderRepository->save($order);
        //$orderItem = new OrderItem($order->getUuid(), $order->getClientEmail(), $order->getTotalSum());

        return $order->getUuid()->toString();
    }
}