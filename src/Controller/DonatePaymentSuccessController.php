<?php

namespace App\Controller;

use App\Entity\DoDonate;
use App\Repository\DoDonateRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DonatePaymentSuccessController extends AbstractController
{
    /**
     * @Route("/donate/terminate/{id}", name="donate_payment_success")
     */
    public function success($id, DoDonateRepository $donateRepository, EntityManagerInterface $em)
    {
        $donate = $donateRepository->find($id);
        if (!$donate) {
            $this->addFlash('warning', "Ce donateur n'existe pas");
        }
        $donate->setStatus(DoDonate::PAIEMENT);
        $em->flush();

        $this->addFlash('success', "Ce paiement a été payée et confirmée");

        return $this->redirect("http://asso-yattim.dioumassi.website/");
    }
}
