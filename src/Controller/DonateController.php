<?php

namespace App\Controller;

use App\Entity\DoDonate;
use App\Form\DoDonateType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
        if($form->isSubmitted() && $form->isValid()) {
          //  dd($form->getData());
            $manager->persist($form->getData());
            $manager->flush();
        }
        return $this->render('donate/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
