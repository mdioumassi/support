<?php

namespace App\Controller;

use App\Entity\DoDonate;
use App\Form\DoDonateType;
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
   * @Route("/donate", name="donate")
   *
   * @param Request $request
   * @param EntityManagerInterface $manager
   * @param SessionInterface $session
   * @return Response
   */
    public function donate(Request $request, EntityManagerInterface $manager, SessionInterface $session) : Response
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
     * STEP 2 - Mes coordonnnees
     * @Route("/mes-coordonnees" , name="mes_coordonnees")
     *
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @param SessionInterface $session
     * @return Response
     */
    public function mesCoordonnees(Request $request, EntityManagerInterface $manager, SessionInterface $session) : Response
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
            $donateName = $form->getData()->getFirstname()." ". strtoupper($form->getData()->getLastname());
            $session->set('donateName', $donateName);
            $manager->persist($donate);
            $manager->flush();

            return $this->redirectToRoute('paiement');
        }

        return $this->render('donate/step2.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * STEP3 - Paiement avec Stripe
     * @Route("/paiement", name="paiement")
     *
     * @param Request $request
     * @param SessionInterface $session
     * @return Response
     */
    public function paiement(Request $request, SessionInterface $session) : Response
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
            'amount' => $amount,
            'donateName' => $session->get('donateName')
        ]);

    }
}
