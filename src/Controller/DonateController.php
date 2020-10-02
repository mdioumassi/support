<?php

namespace App\Controller;

use App\Entity\DoDonate;
use App\Form\DoDonateType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class DonateController extends AbstractController
{
    /**
     * @Route("/donate", name="donate")
     */
    public function step1(Request $request, EntityManagerInterface $manager, SessionInterface $session)
    {
        $session->start();
        if($request->getMethod() == 'POST') {
            $amountOnce = $request->request->get('amount-once');
            $amountFree = $request->request->get('amount-free');
            $session->set('amountOnce', $amountOnce);
            $session->set('amountFree', $amountFree);

            return $this->redirectToRoute('mes_coordonnees');
        }

        return $this->render('donate/step1.html.twig');
    }
    /**
     * @Route("/step2" , name="mes_coordonnees")
     *
     * @param Request $request
     * @param DoDonate $donate
     * @return void
     */
    public function step2(Request $request, EntityManagerInterface $manager, SessionInterface $session)
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
            $manager->persist($donate);
            $manager->flush();

            return $this->redirectToRoute('paiement');
        }

        return $this->render('donate/step2.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/step3", name="paiement")
     *
     * @param Request $request
     * @return void
     */
    public function step3(Request $request, SessionInterface $session)
    {
        $session->start();
        $amount = $session->get('amount');
        \Stripe\Stripe::setApiKey('sk_test_51HN5AkI9xYefOdXpd9CGGjjq4nnAYA7MjgRI3r6R1NP6tbGqxGM6ktsts4Ewd8LqLGpAKbZIe8gE6UnA6rJPJOUP002J5fIKKD');

        $intent = \Stripe\PaymentIntent::create([
            'amount' => $amount * 100,
            'currency' => 'eur',
            'metadata' => ['integration_check' => 'accept_a_payment'],
        ]);
        $client_secret = $intent->client_secret;
        return $this->render('donate/step3.html.twig', [
            'secret' => $client_secret,
            'amount' => $amount
        ]);

    }
}
