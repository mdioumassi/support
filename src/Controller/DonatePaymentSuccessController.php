<?php

namespace App\Controller;

use App\Entity\DoDonate;
use App\Event\DonateSuccessEvent;
use App\Helper\Urls;
use App\Repository\DoDonateRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DonatePaymentSuccessController extends AbstractController
{
    /**
     * @Route("/donate/terminate/{id}", name="donate_payment_success")
     */
    public function success(
        $id,
        DoDonateRepository $donateRepository,
        EntityManagerInterface $em,
        Urls $url,
        EventDispatcherInterface $dispatcher
    )
    {
        $donate = $donateRepository->find($id);
        if (!$donate) {
            $this->addFlash('warning', "Ce donateur n'existe pas");
        }
        $donate->setStatus(DoDonate::PAIEMENT);
        $em->flush();
        //lancer un evenement pour informer le donnateur de la bonne reception de son don
        $donateEvent = new DonateSuccessEvent($donate);
        $dispatcher->dispatch($donateEvent, 'donate.success');
        $this->addFlash('success', "Ce paiement a été payée et confirmée");

        return $this->redirect($url->getUrl() . '/donate/confirmation');
    }
}
