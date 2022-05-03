<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\Offer;
use App\DataFixtures\OffersTypeFixtures;
use App\DataFixtures\DepartmentFixtures;

class OfferFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        for ($cnt=0; $cnt < 50; $cnt++) 
        { 
            $offer = new Offer();
            $offer->setOffersType($this->getReference(OffersTypeFixtures::OFFER_TYPE_REFERENCE));
            $offer->setJobName("Job Name " . strval($cnt + 1));
            $offer->setDescription("Description " . strval($cnt + 1));
            $offer->setTasks("Tasks " . strval($cnt + 1));
            $offer->setWeekHoursNumber($cnt);
            $offer->setTown("Town " . strval($cnt + 1));
            $offer->setDepartment($this->getReference(DepartmentFixtures::DEPARTMENT_REFERENCE));
            $offer->setAddress("Address " . strval($cnt + 1));
            $offer->setCompany("Company " . strval($cnt + 1));
            $offer->setExperience($cnt);
        
            $manager->persist($offer);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            OffersTypeFixtures::class,
            DepartmentFixtures::class,
        ];
    }
}
