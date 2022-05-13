<?php

namespace App\Controller\ClientController;

use App\Entity\Offer;
use App\Form\OfferType;
use App\Repository\OfferRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\SubCategoryRepository;
use App\Repository\CategoryRepository;
use App\Repository\OffersTypeRepository;
use App\Repository\DepartmentRepository;

#[Route('offer')]
class OfferController extends AbstractController
{
    #[Route('/', name: 'offer_index_client', methods: ['GET'])]
    public function test(OfferRepository $offerRepository,
    CategoryRepository $categoryRepository,
    SubCategoryRepository $subCategoryRepository,
    OffersTypeRepository $offersTypeRepository,
    DepartmentRepository $departmentRepository,
    Request $request): Response
    {
        $offers = array();
        // À remplacer par la page du front
        return $this->render('client/offer/index.html.twig', [
            'offers' =>  $offerRepository->getOffersWithFilters($request, $offersPerPage = 25),
            'categories' =>  $categoryRepository->findAll(),
            'sub_categories' => $subCategoryRepository->findAll(),
            'offers_type' => $offersTypeRepository->findAll(),
            'departments' => $departmentRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'offer_new_client', methods: ['GET', 'POST'])]
    public function new(Request $request, OfferRepository $offerRepository): Response
    {
        $offer = new Offer();
        $form = $this->createForm(OfferType::class, $offer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $offerRepository->add($offer);
            return $this->redirectToRoute('offer_index_client', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('client/offer/new.html.twig', [
            'offer' => $offer,
            'form' => $form,
        ]);
    }

    #[Route('/get', name: 'offer_get_client', methods: ['GET'])]
    public function index(OfferRepository $offerRepository, Request $request): Response
    {
        $result = $offerRepository->getOffersWithFilters($request, $offersPerPage = 25);

        $offers = array();

        foreach ($result as $offer) 
        {   
            array_push($offers, $offer->getDataArray());
        }

        return $this->json($offers);
    }
  
    #[Route('/{id}', name: 'offer_show_client', methods: ['GET'])]
    public function show(Offer $offer): Response
    {
        return $this->render('client/offer/show.html.twig', [
            'offer' => $offer,
        ]);
    }
}
