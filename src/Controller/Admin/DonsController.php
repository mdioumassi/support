<?php

namespace App\Controller\Admin;

use App\Repository\DoDonateRepository;
use App\Repository\DonateRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/dons", name="admin_dons_")
 * @package App\Controller\Admin
 */
class DonsController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @return Response
     */
    public function index(DoDonateRepository $donateRepository): Response
    {
        return $this->render('admin/dons/index.html.twig', [
            'dons' => $donateRepository->findAll(),
        ]);
    }
}
