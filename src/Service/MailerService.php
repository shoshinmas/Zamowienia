<?php

declare(strict_types=1);

namespace App\Service;

use Ramsey\Uuid\UuidInterface;
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

    public function sendEmailOnOrder(string $clientEmail, UuidInterface $uuidExternalId)
    {
        $this->mailer->send((new NotificationEmail())
            ->subject('New order')
            ->htmlTemplate('emails/order_notification.html.twig')
            ->from('from@example.com')
            ->to($clientEmail)
            ->context(['id'=>$uuidExternalId]));
    }
}