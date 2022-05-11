<?php

namespace App\Controller\AdminController;

use App\Entity\SubCategory;
use App\Form\SubCategoryType;
use App\Repository\SubCategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('admin/sub/category')]
class SubCategoryController extends AbstractController
{
    #[Route('/', name: 'sub_category_index_admin', methods: ['GET'])]
    public function index(SubCategoryRepository $subCategoryRepository): Response
    {
        return $this->render('admin/sub_category/index.html.twig', [
            'sub_categories' => $subCategoryRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'sub_category_new_admin', methods: ['GET', 'POST'])]
    public function new(Request $request, SubCategoryRepository $subCategoryRepository): Response
    {
        $subCategory = new SubCategory();
        $form = $this->createForm(SubCategoryType::class, $subCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $subCategoryRepository->add($subCategory);
            return $this->redirectToRoute('sub_category_index_admin', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/sub_category/new.html.twig', [
            'sub_category' => $subCategory,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'sub_category_show_admin', methods: ['GET'])]
    public function show(SubCategory $subCategory): Response
    {
        return $this->render('admin/sub_category/show.html.twig', [
            'sub_category' => $subCategory,
        ]);
    }

    #[Route('/{id}/edit', name: 'sub_category_edit_admin', methods: ['GET', 'POST'])]
    public function edit(Request $request, SubCategory $subCategory, SubCategoryRepository $subCategoryRepository): Response
    {
        $form = $this->createForm(SubCategoryType::class, $subCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $subCategoryRepository->add($subCategory);
            return $this->redirectToRoute('sub_category_index_admin', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/sub_category/edit.html.twig', [
            'sub_category' => $subCategory,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'sub_category_delete_admin', methods: ['POST'])]
    public function delete(Request $request, SubCategory $subCategory, SubCategoryRepository $subCategoryRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$subCategory->getId(), $request->request->get('_token'))) {
            $subCategoryRepository->remove($subCategory);
        }

        return $this->redirectToRoute('sub_category_index_admin', [], Response::HTTP_SEE_OTHER);
    }
}
