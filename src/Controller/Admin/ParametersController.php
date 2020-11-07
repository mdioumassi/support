<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/admin/parameters", name="admin_parameters_")
 * @package App\Controller\Admin
 */
class ParametersController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        return $this->render('parameters/index.html.twig', [
            'controller_name' => 'ParametersController',
        ]);
    }
}
