<?php

namespace App\Controller;

use http\Env\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class StripeController extends AbstractController
{
    /**
     * @Route("/stripe/{amount}", name="stripe")
     */
    public function stripe($amount)
    {
        dd($amount);
        \Stripe\Stripe::setApiKey('sk_test_51HN5AkI9xYefOdXpd9CGGjjq4nnAYA7MjgRI3r6R1NP6tbGqxGM6ktsts4Ewd8LqLGpAKbZIe8gE6UnA6rJPJOUP002J5fIKKD');

        $intent = \Stripe\PaymentIntent::create([
            'amount' => $amount,
            'currency' => 'eur',
            'metadata' => ['integration_check' => 'accept_a_payment'],
        ]);
        $client_secret = $intent->client_secret;
       // dd($client_secret);
        return $this->render('stripe/index.html.twig', [
            'secret' => $client_secret,
        ]);
    }
}
