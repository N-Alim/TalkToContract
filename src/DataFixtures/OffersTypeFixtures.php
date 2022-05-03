<?php

namespace App\DataFixtures;

use App\Entity\OffersType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class OffersTypeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $offersType = new OffersType();
        $offersType->setLabel('offersType');
        // $product = new Product();

        $manager->persist($offersType);

        $manager->flush();
    }
}
