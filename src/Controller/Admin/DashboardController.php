<?php
namespace App\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use App\Repository\OrderRepository;

class DashboardController extends AbstractController
{
    #[IsGranted('ROLE_USER')]
    #[Route('/admin/dashboard', name: 'admin_dashboard')]


    public function index(Environment $twig, OrderRepository $orderRepository): Response
    {
        return new Response($twig->render('admin/dashboard/index.html.twig', [
            'controller_name' => 'DashboardController',
            'orders' => $orderRepository->findAll(),
        ]));
    }
}