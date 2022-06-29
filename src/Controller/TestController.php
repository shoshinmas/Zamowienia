<?php

namespace App\Controller;

use App\Entity\Order;
use App\Form\Type\CartFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    #[Route(path: '/test', name: 'form_test')]
    public function index(Request $request, EntityManagerInterface $em): Response
    {
        $productTest = ['id'=> 001, 'name' => 'Blabla', 'price' => 100, 'visible' => TRUE ];
        $productPrice = $productTest['price'];
        $productId = $productTest['id'];
        $form = $this->createForm(CartFormType::class, $productId);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $order = $form->getData();
            $pSum = $order->getGeneralAmount($productPrice);
            $order->setStatus('PENDING');
            $order->setTotalSum($pSum);
            $em->persist($order);
            $em->flush();
            // return $this->redirectToRoute('app_product', [$order]);
        }
        return $this->render('test/index.html.twig', [
            'controller_name' => 'ProductController',
            'product' => $productTest,
            'form' => $form->createView()
        ]);
    }
}
