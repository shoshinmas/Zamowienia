<?php

declare(strict_types=1);

namespace App\Controller;

use App\OrderItem\OrderItem;

use App\Repository\OrderRepository;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    public function __construct(private readonly OrderRepository $orderRepository)
    {
    }

    #[Route('/order/{externalId}', name: 'app_order')]
    public function showOrder(string $externalId): Response
    {
        $uuidExternalId = Uuid::fromString($externalId);
        return $this->render('order/index.html.twig', [
            'order' => $this->orderRepository->findOneByUuid($uuidExternalId),
        ]);
    }
    /*
        public function __construct(
            private readonly OrderRepository $orderRepository
        ){
        }
        #[Route('/order', name: 'app_order')]
        public function showOrder(): Response
        {
            return $this->render('order/index.html.twig', [
                'orders' => $this->orderRepository->findAll(),
            ]);
        }*/
}