<?php

namespace App\Controller\AdminController;


use App\Entity\OfferType;
use App\Form\OfferTypeType;
use App\Repository\OfferTypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/offer_type')]
class OfferTypeController extends AbstractController
{
    #[Route('/', name: 'offer_type_index_admin', methods: ['GET'])]
    public function index(OfferTypeRepository $offerTypeRepository): Response
    {
        return $this->render('/admin/offer_type/index.html.twig', [
            'offer_types' => $offerTypeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'offer_type_new_admin', methods: ['GET', 'POST'])]
    public function new(Request $request, OfferTypeRepository $offerTypeRepository): Response
    {
        $offerType = new OfferType();
        $form = $this->createForm(OfferTypeType::class, $offerType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $offerTypeRepository->add($offerType);
            return $this->redirectToRoute('offer_type_index_admin', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('/admin/offer_type/new.html.twig', [
            'offer_type' => $offerType,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'offer_type_show_admin', methods: ['GET'])]
    public function show(OfferType $offerType): Response
    {
        return $this->render('/admin/offer_type/show.html.twig', [
            'offer_type' => $offerType,
        ]);
    }

    #[Route('/{id}/edit', name: 'offer_type_edit_admin', methods: ['GET', 'POST'])]
    public function edit(Request $request, OfferType $offerType, OfferTypeRepository $offerTypeRepository): Response
    {
        $form = $this->createForm(OfferTypeType::class, $offerType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $offerTypeRepository->add($offerType);
            return $this->redirectToRoute('offer_type_index_admin', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('/admin/offer_type/edit.html.twig', [
            'offer_type' => $offerType,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'offer_type_delete_admin', methods: ['POST'])]
    public function delete(Request $request, OfferType $offerType, OfferTypeRepository $offerTypeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$offerType->getId(), $request->request->get('_token'))) {
            $offerTypeRepository->remove($offerType);
        }

        return $this->redirectToRoute('offer_type_index_admin', [], Response::HTTP_SEE_OTHER);
    }
}
