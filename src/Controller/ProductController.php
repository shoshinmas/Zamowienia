<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Order;
use App\Form\Type\CartFormType;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{


    #[Route(path: '/', name: 'app_product')]
    public function index(Request $request, EntityManagerInterface $em, ProductRepository $productRepository): Response
    {
        $order = new Order();
        $order->setQuantity(2);
        $form = $this->createForm(CartFormType::class, $order);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $quantitySum = 5;
            var_dump($quantitySum);
            $order = $form->getData();
            $order
                ->setStatus('pending')
            ->setTotalSum(2);
            $em->persist($order);
            $em->flush();
           // return $this->redirectToRoute('app_product', [$order]);
        }
        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
            'products' => $productRepository->findAll(),
            'order' => $order,
            'form' => $form->createView()
        ]);
    }


}
