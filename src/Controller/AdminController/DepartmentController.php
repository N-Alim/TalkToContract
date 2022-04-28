<?php

namespace App\Controller\AdminController;

use App\Entity\Department;
use App\Form\DepartmentType;
use App\Repository\DepartmentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/department')]
class DepartmentController extends AbstractController
{
    #[Route('/', name: 'department_index_admin', methods: ['GET'])]
    public function index(DepartmentRepository $departmentRepository): Response
    {
        return $this->render('admin/department/index.html.twig', [
            'departments' => $departmentRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'department_new_admin', methods: ['GET', 'POST'])]
    public function new(Request $request, DepartmentRepository $departmentRepository): Response
    {
        $department = new Department();
        $form = $this->createForm(DepartmentType::class, $department);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $departmentRepository->add($department);
            return $this->redirectToRoute('department_index_admin', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/department/new.html.twig', [
            'department' => $department,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'department_show_admin', methods: ['GET'])]
    public function show(Department $department): Response
    {
        return $this->render('admin/department/show.html.twig', [
            'department' => $department,
        ]);
    }

    #[Route('/{id}/edit', name: 'department_edit_admin', methods: ['GET', 'POST'])]
    public function edit(Request $request, Department $department, DepartmentRepository $departmentRepository): Response
    {
        $form = $this->createForm(DepartmentType::class, $department);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $departmentRepository->add($department);
            return $this->redirectToRoute('department_index_admin', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/department/edit.html.twig', [
            'department' => $department,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'department_delete_admin', methods: ['POST'])]
    public function delete(Request $request, Department $department, DepartmentRepository $departmentRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$department->getId(), $request->request->get('_token'))) {
            $departmentRepository->remove($department);
        }

        return $this->redirectToRoute('department_index_admin', [], Response::HTTP_SEE_OTHER);
    }
}
