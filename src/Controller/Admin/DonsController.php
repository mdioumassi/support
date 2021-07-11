<?php

namespace App\Controller\Admin;

use App\Repository\DoDonateRepository;
use App\Repository\DonateRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
            'dons' => $donateRepository->findAllByCreatedAt(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit")
     * @param $id
     * @param Request $request
     */
    public function edit($id, Request $request, DoDonateRepository $donateRepository) {
       $donate = $donateRepository->find($id);
        return $this->render('admin/dons/edit.html.twig', [
         //   'donate' => $donate,
        ]);
    }

    /**
     * @Route("/{id}/delete", name="delete")
     * @param $id
     * @param Request $request
     */
    public function delete($id, Request $request, DoDonateRepository $donateRepository) {
        $donate = $donateRepository->find($id);
        return $this->render('admin/dons/edit.html.twig', [
            //   'donate' => $donate,
        ]);
    }
}
