<?php

declare(strict_types=1);

namespace App\Controller;

use App\Form\BaseType;
use App\Repository\ProductRepository;
use App\UseCase\CreateOrder;
use App\UseCase\CreateOrderModel;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{

    public function __construct(
        private readonly ProductRepository $productRepository,
        private readonly CreateOrder $createOrder
    ){
    }

    #[Route(path: '/', name: 'app_product', methods: ["GET", "POST"])]
    public function index(Request $request): Response
    {
        $form = $this->createForm(BaseType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->createOrder->execute(CreateOrderModel::fromRequest($request));
        }

        return $this->render('product/index.html.twig', [
            'products' => $this->productRepository->findAll(),
            'form' => $form->createView()
        ]);
    }
}
