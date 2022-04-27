<?php

namespace App\Controller\ClientController;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'homepage_client')]
    public function index(): Response
    {
        return $this->render('client/client.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }
}
