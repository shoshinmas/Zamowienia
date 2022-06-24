<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
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
    public function addToOrder(ManagerRegistry $doctrine, Request $request, EntityManagerInterface $em): Response
    {
        $orderedProductId = (int) ($request->query->get('id'));
        $pPrice = 1;
        $order = new Order();
        $order->addProduct($doctrine->getRepository(Product::class)->find($orderedProductId));
        $form = $this->createFormBuilder($order)
            ->add('clientEmail', TextType::class)
            ->add('quantity', IntegerType::class)
            ->add('makeOrder', SubmitType::class, ['label' => 'Make Order'])
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $order->setStatus("Pending");
            $order->setTotalSum((int)('quantity'));
            //$order->setClientEmail($data['clientEmail']);
            $em->persist($order);
            $em->flush();
            //return $this->redirectToRoute('app_product');
        }
        return $this->render('order/index.html.twig', [
            'form'=> $form->createView(),
            'order'=> $order
        ]);
    }
}