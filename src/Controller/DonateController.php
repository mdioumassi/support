<?php

namespace App\Controller;

use App\Entity\Donate;
use App\Form\DonateType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DonateController extends AbstractController
{
    /**
     * @Route("/donate", name="donate")
     */
    public function index(Request $request)
    {
        $donate = new Donate();
        $donate->setCreatedAt(new \DateTime());
        $form = $this->createForm(DonateType::class, $donate);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
          //  dd($form->getData());
        }
        return $this->render('donate/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
