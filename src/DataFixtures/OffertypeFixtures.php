<?php

namespace App\DataFixtures;

use App\Entity\OfferType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class OffertypeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $offertype = new OfferType();
        $offertype->setLabel('offerType');
        // $product = new Product();

        $manager->persist($offertype);

        $manager->flush();
    }
}
