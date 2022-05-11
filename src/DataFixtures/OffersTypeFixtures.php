<?php

namespace App\DataFixtures;

use App\Entity\OffersType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class OffersTypeFixtures extends Fixture
{
    public const OFFER_TYPE_REFERENCE = 'offer_type';

    public function load(ObjectManager $manager): void
    {
        $offersType = new OffersType();
        $offersType->setLabel('Distanciel');

        $manager->persist($offersType);

        $offersType2 = new OffersType();
        $offersType2->setLabel('Semi-distanciel');

        $manager->persist($offersType2);

        $offersType3 = new OffersType();
        $offersType3->setLabel('Présentiel');

        $manager->persist($offersType3);

        $manager->flush();

        $this->addReference(self::OFFER_TYPE_REFERENCE, $offersType);
    }
}
