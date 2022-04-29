<?php

namespace App\Controller\AdminController;

use App\Entity\Skill;
use App\Form\SkillType;
use App\Repository\SkillRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('admin/skill')]
class SkillController extends AbstractController
{
    #[Route('/', name: 'skill_index_admin', methods: ['GET'])]
    public function index(SkillRepository $SkillRepository): Response
    {
        return $this->render('admin/skill/index.html.twig', [
            'skill' => $SkillRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'skill_new_admin', methods: ['GET', 'POST'])]
    public function new(Request $request, SkillRepository $SkillRepository): Response
    {
        $skill = new Skill();
        $form = $this->createForm(SkillType::class, $skill);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $SkillRepository->add($skill);
            return $this->redirectToRoute('skill_index_admin', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/skill/new.html.twig', [
            'skill' => $skill,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'skill_show_admin', methods: ['GET'])]
    public function show(Skill $skill): Response
    {
        return $this->render('admin/skill/show.html.twig', [
            'skill' => $skill,
        ]);
    }

    #[Route('/{id}/edit', name: 'skill_edit_admin', methods: ['GET', 'POST'])]
    public function edit(Request $request, Skill $skill, SkillRepository $SkillRepository): Response
    {
        $form = $this->createForm(SkillType::class, $skill);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $SkillRepository->add($skill);
            return $this->redirectToRoute('skill_index_admin', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/skill/edit.html.twig', [
            'skill' => $skill,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'skill_delete_admin', methods: ['POST'])]
    public function delete(Request $request, Skill $skill, SkillRepository $SkillRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$skill->getId(), $request->request->get('_token'))) {
            $SkillRepository->remove($skill);
        }

        return $this->redirectToRoute('skill_index_admin', [], Response::HTTP_SEE_OTHER);
    }
}