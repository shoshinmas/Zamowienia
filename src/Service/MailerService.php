<?php

namespace App\Service;

use App\Repository\OrderRepository;
use Symfony\Bridge\Twig\Mime\NotificationEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\MailerInterface;

class MailerService extends AbstractController
{
    public function __construct(
        private readonly MailerInterface $mailer,
    )
    {
    }

    public function sendEmailOnOrder(string $clientEmail, string $uuidExternalId)
    {
        $this->mailer->send((new NotificationEmail())
            ->subject('New order')
            ->htmlTemplate('emails/order_notification.html.twig')
            ->from('from@example.com')
            ->to($clientEmail)
            ->context(['id'=>$uuidExternalId]));
    }

}