<?php


namespace App\EventDispatcher;


use App\Entity\Newsletter;
use App\Event\DonateSuccessEvent;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;

class NewsletterSubscriber implements EventSubscriberInterface
{
    protected $logger;
    protected $mailer;
    protected $em;

    public function __construct(LoggerInterface $logger, MailerInterface $mailer, EntityManagerInterface $manager)
    {
        $this->logger = $logger;
        $this->mailer = $mailer;
        $this->em = $manager;
    }

    public static function getSubscribedEvents()
    {
            return [
                'donate.newsletter' => 'sendSubscriberEmail',
            ];
    }

    public function sendSubscriberEmail(DonateSuccessEvent $donateSuccessEvent)
    {
        $newsletter = new Newsletter();
        $donate = $donateSuccessEvent->getDonate();

        if ($donate->getReceiveInfo()) {
            try{
                $newsletter->setEmail($donate->getEmail());
                $this->em->persist($newsletter);
                $this->em->flush();
            } catch (UniqueConstraintViolationException $e ) {
                    var_dump($e->getMessage());
            }

        }
    }

}