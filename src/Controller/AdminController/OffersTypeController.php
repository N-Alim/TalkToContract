<?php

namespace App\Controller\AdminController;


use App\Entity\OffersType;
use App\Form\OffersTypeType;
use App\Repository\OffersTypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/offers_type')]
class OffersTypeController extends AbstractController
{
    #[Route('/', name: 'offers_type_index_admin', methods: ['GET'])]
    public function index(OffersTypeRepository $offersTypeRepository): Response
    {
        return $this->render('/admin/offers_type/index.html.twig', [
            'offers_types' => $offersTypeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'offers_type_new_admin', methods: ['GET', 'POST'])]
    public function new(Request $request, OffersTypeRepository $offersTypeRepository): Response
    {
        $offersType = new OffersType();
        $form = $this->createForm(OffersTypeType::class, $offersType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $offersTypeRepository->add($offersType);
            return $this->redirectToRoute('offers_type_index_admin', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('/admin/offers_type/new.html.twig', [
            'offers_type' => $offersType,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'offers_type_show_admin', methods: ['GET'])]
    public function show(OffersType $offersType): Response
    {
        return $this->render('/admin/offers_type/show.html.twig', [
            'offers_type' => $offersType,
        ]);
    }

    #[Route('/{id}/edit', name: 'offers_type_edit_admin', methods: ['GET', 'POST'])]
    public function edit(Request $request, OffersType $offersType, OffersTypeRepository $offersTypeRepository): Response
    {
        $form = $this->createForm(OffersTypeType::class, $offersType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $offersTypeRepository->add($offersType);
            return $this->redirectToRoute('offers_type_index_admin', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('/admin/offers_type/edit.html.twig', [
            'offers_type' => $offersType,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'offers_type_delete_admin', methods: ['POST'])]
    public function delete(Request $request, OffersType $offersType, OffersTypeRepository $offersTypeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$offersType->getId(), $request->request->get('_token'))) {
            $offersTypeRepository->remove($offersType);
        }

        return $this->redirectToRoute('offers_type_index_admin', [], Response::HTTP_SEE_OTHER);
    }
}
