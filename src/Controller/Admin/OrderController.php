<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Repository\OrderRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{

    public function __construct(
        private readonly OrderRepository $orderRepository)
    {

    }
   // #[IsGranted('ROLE_USER')]
    #[Route('/admin/order', name: 'admin_order')]
    public function index(): Response
    {
        return $this->render('admin/dashboard/index.html.twig', [
            'orders' => $this->orderRepository->findAll(),
        ]);
    }
}