<?php

namespace App\Controller\ClientController;

use App\Entity\Offer;
use App\Form\OfferType;
use App\Repository\OfferRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('offer')]
class OfferController extends AbstractController
{
    #[Route('/', name: 'offer_index_client', methods: ['GET'])]
    public function test(OfferRepository $offerRepository): Response
    {
        // À remplacer par la page du front
        return $this->render('client/offer/index.html.twig', [
            'offers' => $offerRepository->findAll(),
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
