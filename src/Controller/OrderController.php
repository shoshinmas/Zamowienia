<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\Product;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\VarDumper\VarDumper;

class OrderController extends AbstractController
{
    #[Route('/order', name: 'app_order')]
    public function addToOrder(ManagerRegistry $doctrine, Request $request): Response
    {
        $orderedProductId = (int) ($request->query->get('id'));
        $order = new Order();
        $order->setClientEmail('clientEmail');
        $order->addProduct($doctrine->getRepository(Product::class)->find($orderedProductId));
        $order = $this->createFormBuilder($order)
            ->add('clientEmail', TextType::class)
            ->add('quantity', IntegerType::class)
            ->add('makeOrder', SubmitType::class, ['label' => 'Make Order'])
            ->getForm();
        return $this->renderForm('order/index.html.twig', [
            'order'=> $order
        ]);
    }
}