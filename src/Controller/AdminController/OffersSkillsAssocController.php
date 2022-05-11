<?php

namespace App\Controller\AdminController;

use App\Entity\OffersSkillsAssoc;
use App\Form\OffersSkillsAssocType;
use App\Repository\OffersSkillsAssocRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('admin/offers/skills/assoc')]
class OffersSkillsAssocController extends AbstractController
{
    #[Route('/', name: 'offers_skills_assoc_index_admin', methods: ['GET'])]
    public function index(OffersSkillsAssocRepository $offersSkillsAssocRepository): Response
    {
        return $this->render('admin/offers_skills_assoc/index.html.twig', [
            'offers_skills_assocs' => $offersSkillsAssocRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'offers_skills_assoc_new_admin', methods: ['GET', 'POST'])]
    public function new(Request $request, OffersSkillsAssocRepository $offersSkillsAssocRepository): Response
    {
        $offersSkillsAssoc = new OffersSkillsAssoc();
        $form = $this->createForm(OffersSkillsAssocType::class, $offersSkillsAssoc);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $offersSkillsAssocRepository->add($offersSkillsAssoc);
            return $this->redirectToRoute('offers_skills_assoc_index_admin', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/offers_skills_assoc/new.html.twig', [
            'offers_skills_assoc' => $offersSkillsAssoc,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'offers_skills_assoc_show_admin', methods: ['GET'])]
    public function show(OffersSkillsAssoc $offersSkillsAssoc): Response
    {
        return $this->render('admin/offers_skills_assoc/show.html.twig', [
            'offers_skills_assoc' => $offersSkillsAssoc,
        ]);
    }

    #[Route('/{id}/edit', name: 'offers_skills_assoc_edit_admin', methods: ['GET', 'POST'])]
    public function edit(Request $request, OffersSkillsAssoc $offersSkillsAssoc, OffersSkillsAssocRepository $offersSkillsAssocRepository): Response
    {
        $form = $this->createForm(OffersSkillsAssocType::class, $offersSkillsAssoc);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $offersSkillsAssocRepository->add($offersSkillsAssoc);
            return $this->redirectToRoute('offers_skills_assoc_index_admin', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/offers_skills_assoc/edit.html.twig', [
            'offers_skills_assoc' => $offersSkillsAssoc,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'offers_skills_assoc_delete_admin', methods: ['POST'])]
    public function delete(Request $request, OffersSkillsAssoc $offersSkillsAssoc, OffersSkillsAssocRepository $offersSkillsAssocRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$offersSkillsAssoc->getId(), $request->request->get('_token'))) {
            $offersSkillsAssocRepository->remove($offersSkillsAssoc);
        }

        return $this->redirectToRoute('offers_skills_assoc_index_admin', [], Response::HTTP_SEE_OTHER);
    }
}
