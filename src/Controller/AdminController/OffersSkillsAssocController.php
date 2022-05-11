<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OffersSkillsAssocController extends AbstractController
{
    #[Route('admin/offers/skills/assoc', name: 'offers_skills_assoc_admin')]
    public function index(): Response
    {
        return $this->render('offers_skills_assoc/index.html.twig', [
            'controller_name' => 'OffersSkillsAssocController',
        ]);
    }
}
