<?php

namespace App\Controller\AdminController;

use App\Entity\Skills;
use App\Form\SkillsType;
use App\Repository\SkillsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('admin/skills')]
class SkillsController extends AbstractController
{
    #[Route('/', name: 'skills_index_admin', methods: ['GET'])]
    public function index(SkillsRepository $SkillsRepository): Response
    {
        return $this->render('admin/skills/index.html.twig', [
            'skills' => $SkillsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'skills_new_admin', methods: ['GET', 'POST'])]
    public function new(Request $request, SkillsRepository $SkillsRepository): Response
    {
        $skills = new Skills();
        $form = $this->createForm(SkillsType::class, $skills);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $SkillsRepository->add($skills);
            return $this->redirectToRoute('skills_index_admin', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/skills/new.html.twig', [
            'skills' => $skills,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'skills_show_admin', methods: ['GET'])]
    public function show(Skills $skills): Response
    {
        return $this->render('admin/skills/show.html.twig', [
            'skills' => $skills,
        ]);
    }

    #[Route('/{id}/edit', name: 'skills_edit_admin', methods: ['GET', 'POST'])]
    public function edit(Request $request, Skills $skills, SkillsRepository $SkillsRepository): Response
    {
        $form = $this->createForm(SkillsType::class, $skills);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $SkillsRepository->add($skills);
            return $this->redirectToRoute('skills_index_admin', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/skills/edit.html.twig', [
            'skills' => $skills,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'skills_delete_admin', methods: ['POST'])]
    public function delete(Request $request, Skills $skills, SkillsRepository $SkillsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$skills->getId(), $request->request->get('_token'))) {
            $SkillsRepository->remove($skills);
        }

        return $this->redirectToRoute('skills_index_admin', [], Response::HTTP_SEE_OTHER);
    }
}