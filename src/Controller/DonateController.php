<?php

namespace App\Controller;

use App\Entity\DoDonate;
use App\Form\DoDonateType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DonateController extends AbstractController
{
    /**
     * @Route("/donate", name="donate")
     */
    public function index(Request $request, EntityManagerInterface $manager)
    {
        $donate = new DoDonate();
        $donate->setCreatedAt(new \DateTime());
        $form = $this->createForm(DoDonateType::class, $donate);
        $form->handleRequest($request);

        $form->getData();
      // dd($data);
       /* if( $data instanceof DoDonate ) {
            $amount = $data->getAmountOnce() ?? $data->getAmountFree();
       //     dd($amount);
            \Stripe\Stripe::setApiKey('sk_test_51HN5AkI9xYefOdXpd9CGGjjq4nnAYA7MjgRI3r6R1NP6tbGqxGM6ktsts4Ewd8LqLGpAKbZIe8gE6UnA6rJPJOUP002J5fIKKD');
            $intent = \Stripe\PaymentIntent::create([
                'amount' => 1000,//$amount*100 ?? 0.500,
                'currency' => 'eur',
                'metadata' => ['integration_check' => 'accept_a_payment'],
            ]);
            $secret = $intent->client_secret;
        }*/
       // dd($form->isValid());
        if($form->isSubmitted() && $form->isValid()) {

            $manager->persist($form->getData());
            $manager->flush();
        }
/*
        $amount = $donate->get('amountOnce')->getData() ?? $donate->get('amount_free')->getData();

        \Stripe\Stripe::setApiKey('sk_test_51HN5AkI9xYefOdXpd9CGGjjq4nnAYA7MjgRI3r6R1NP6tbGqxGM6ktsts4Ewd8LqLGpAKbZIe8gE6UnA6rJPJOUP002J5fIKKD');
        $intent = \Stripe\PaymentIntent::create([
            'amount' => $amount*100,
            'currency' => 'eur',
            'metadata' => ['integration_check' => 'accept_a_payment'],
        ]);
        $secret = $intent->client_secret;*/
        return $this->render('donate/index.html.twig', [
            'form' => $form->createView(),
          // 'secret' => $secret
        ]);
    }

    public function stripe($amount)
    {
       // dd($amount);
        \Stripe\Stripe::setApiKey('sk_test_51HN5AkI9xYefOdXpd9CGGjjq4nnAYA7MjgRI3r6R1NP6tbGqxGM6ktsts4Ewd8LqLGpAKbZIe8gE6UnA6rJPJOUP002J5fIKKD');
        $intent = \Stripe\PaymentIntent::create([
            'amount' => $amount*100,
            'currency' => 'eur',
            'metadata' => ['integration_check' => 'accept_a_payment'],
        ]);
        return $intent->client_secret;
    }
}
