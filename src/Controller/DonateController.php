<?php

namespace App\Controller;

use App\Entity\DoDonate;
use App\Form\DoDonateType;
use App\Helper\Urls;
use App\Stripe\StripeService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class DonateController extends AbstractController
{

    /**
     * STEP1 - Don
     * @Route("/", name="donate")
     *
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @param SessionInterface $session
     * @return Response
     */
    public function donate(Request $request, EntityManagerInterface $manager, SessionInterface $session, Urls $url): Response
    {
        $session->start();
        if ($request->getMethod() == 'POST') {
            $amountOnce = $request->request->get('amount-once');
            $amountFree = $request->request->get('amount-free');
            $session->set('amountOnce', $amountOnce);
            $session->set('amountFree', $amountFree);

            return $this->redirectToRoute('mes_coordonnees');
        }

        return $this->render('donate/step1.html.twig', ['urlSiteProd' => $url->getUrl()]);
    }

    /**
     * STEP 2 - Mes coordonnnees
     * @Route("/mes-coordonnees" , name="mes_coordonnees")
     *
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @param SessionInterface $session
     * @return Response
     */
    public function mesCoordonnees(Request $request, EntityManagerInterface $manager, SessionInterface $session, Urls $url): Response
    {
        $session->start();
        $donate = new DoDonate();
        $donate->setCreatedAt(new \DateTime());
        $form = $this->createForm(DoDonateType::class, $donate);

        $form->handleRequest($request);

        if ($session->get('amountOnce')) {
            $amount = $session->get('amountOnce');
            $donate->setAmountOnce($amount);
        }

        if ($session->get('amountFree')) {
            $amount = $session->get('amountFree');
            $donate->setAmountFree($amount);
        }

        $session->set('amount', $amount);

        if ($form->isSubmitted() && $form->isValid()) {
            $donateName = $form->getData()->getFirstname() . " " . strtoupper($form->getData()->getLastname());
            $session->set('donateName', $donateName);
            $manager->persist($donate);
            $manager->flush();
            return $this->redirectToRoute('paiement', ['donateId' => $donate->getId()]);
        }

        return $this->render('donate/step2.html.twig', [
            'form' => $form->createView(),
            'urlSiteProd' => $url->getUrl()
        ]);
    }

    /**
     * STEP3 - Paiement avec Stripe
     * @Route("/paiement/donate/{donateId<\d+>}", name="paiement")
     *
     * @param Request $request
     * @param SessionInterface $session
     * @return Response
     */
    public function paiement(Request $request, SessionInterface $session, StripeService $stripeService, $donateId, Urls $url): Response
    {
        $session->start();
        $amount = $session->get('amount');
        $intent = $stripeService->getPaymentIntent($amount);

        return $this->render('donate/step3.html.twig', [
            'clientSecret' => $intent->client_secret,
            'amount' => $amount,
            'donateName' => $session->get('donateName'),
            'donateId' => $donateId,
            'stripePublicKey' => $stripeService->getPublicKey(),
            'urlSiteProd' => $url->getUrl()
        ]);
    }
}
