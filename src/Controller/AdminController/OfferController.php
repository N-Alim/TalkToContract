<?php

namespace App\Controller\AdminController;

use App\Entity\Offer;
use App\Form\OfferType;
use App\Repository\OfferRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('admin/offer')]
class OfferController extends AbstractController
{
    #[Route('/', name: 'offer_index_admin', methods: ['GET'])]
    public function index(OfferRepository $offerRepository): Response
    {
        return $this->render('admin/offer/index.html.twig', [
            'offers' => $offerRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'offer_new_admin', methods: ['GET', 'POST'])]
    public function new(Request $request, OfferRepository $offerRepository): Response
    {
        $offer = new Offer();
        $form = $this->createForm(OfferType::class, $offer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $offerRepository->add($offer);
            return $this->redirectToRoute('offer_index_admin', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/offer/new.html.twig', [
            'offer' => $offer,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'offer_show_admin', methods: ['GET'])]
    public function show(Offer $offer): Response
    {
        return $this->render('admin/offer/show.html.twig', [
            'offer' => $offer,
        ]);
    }

    #[Route('/{id}/edit', name: 'offer_edit_admin', methods: ['GET', 'POST'])]
    public function edit(Request $request, Offer $offer, OfferRepository $offerRepository): Response
    {
        $form = $this->createForm(OfferType::class, $offer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $offerRepository->add($offer);
            return $this->redirectToRoute('offer_index_admin', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/offer/edit.html.twig', [
            'offer' => $offer,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'offer_delete_admin', methods: ['POST'])]
    public function delete(Request $request, Offer $offer, OfferRepository $offerRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$offer->getId(), $request->request->get('_token'))) {
            $offerRepository->remove($offer);
        }

        return $this->redirectToRoute('offer_index_admin', [], Response::HTTP_SEE_OTHER);
    }
}
