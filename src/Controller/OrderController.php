<?php

declare(strict_types=1);

namespace App\Controller;

use App\OrderItem\OrderItem;

use App\Repository\OrderRepository;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Twig\Mime\NotificationEmail;
use Symfony\Component\Mailer\MailerInterface;

class OrderController extends AbstractController
{
    private $mailer;

    public function __construct(private readonly OrderRepository $orderRepository, MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    #[Route('/order/{externalId}', name: 'app_order')]
    public function showOrder(string $externalId): Response
    {
        $uuidExternalId = Uuid::fromString($externalId);
        $this->mailer->send((new NotificationEmail())
        ->subject('New order')
        ->htmlTemplate('emails/order_notification.html.twig')
        ->from('from@example.com')
        ->to($this->orderRepository->findOneByUuid($uuidExternalId)->getClientEmail())
        ->context(['order'=>$this->orderRepository->findOneByUuid($uuidExternalId)]));
        return $this->render('order/index.html.twig', [
            'order' => $this->orderRepository->findOneByUuid($uuidExternalId),
        ]);
    }
    /*
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
        }*/
}