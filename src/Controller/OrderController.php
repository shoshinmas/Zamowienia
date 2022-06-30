<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Order;
use App\Repository\OrderRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{

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
    }
}