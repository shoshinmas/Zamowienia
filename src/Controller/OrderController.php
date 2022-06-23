<?php

namespace App\Controller;

use App\Entity\Order;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    #[Route('/order', name: 'app_order')]
    public function index(ProductRepository $productRepository, Order $order): Response
    {
        return $this->render('order/index.html.twig', [
            'controller_name' => 'OrderController',
            'products' => $order->getClientEmail(),
        ]);
    }
}
