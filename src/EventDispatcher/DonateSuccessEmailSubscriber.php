<?php


namespace App\EventDispatcher;


use App\Event\DonateSuccessEvent;
use Psr\Log\LoggerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;

class DonateSuccessEmailSubscriber implements EventSubscriberInterface
{
    protected $logger;
    protected $mailer;

    public function __construct(LoggerInterface $logger, MailerInterface $mailer)
    {
        $this->logger = $logger;
        $this->mailer = $mailer;
    }

    public static function getSubscribedEvents()
    {
            return [
                'donate.success' => 'sendSuccessEmail'
            ];
    }

    public function sendSuccessEmail(DonateSuccessEvent $donateSuccessEvent)
    {
        $donate = $donateSuccessEvent->getDonate();
        $email = new TemplatedEmail();
        $email->to($donate->getEmail())
              ->from(new Address("contact@dioumassi.website", "Reception de votre don."))
              ->subject("Reception du don!")
              ->htmlTemplate('emails/donate_success.html.twig')
              ->context([
                  'donate' => $donate
              ]);
       $this->mailer->send($email);
    }

}