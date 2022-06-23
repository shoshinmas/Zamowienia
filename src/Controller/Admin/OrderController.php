<?php

namespace App\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    #[IsGranted('ROLE_USER')]
    #[Route('/admin/order', name: 'admin_order')]
    public function index(): Response
    {
        return $this->render('admin/order/index.html.twig', [
            'controller_name' => 'OrderController',
        ]);
    }
}