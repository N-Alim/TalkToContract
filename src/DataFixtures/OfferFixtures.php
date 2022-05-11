<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\Offer;
use App\DataFixtures\OffersTypeFixtures;
use App\DataFixtures\DepartmentFixtures;
use App\DataFixtures\SkillFixtures;
use App\DataFixtures\SubCategoryFixtures;
use App\DataFixtures\UserFixtures;

class OfferFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        for ($cnt=0; $cnt < 50; $cnt++) 
        { 
            $offer = new Offer();
            $offer->setRecruiter($this->getReference(UserFixtures::RECRUITER_USER_REFERENCE));
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
            $offer->addSkill($this->getReference(SkillFixtures::SKILL_REFERENCE));
            $offer->setSubCategory($this->getReference(SubCategoryFixtures::SUBCATEGORY_REFERENCE));
        
            $manager->persist($offer);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
            OffersTypeFixtures::class,
            DepartmentFixtures::class,
            SkillFixtures::class,
            SubCategoryFixtures::class,
        ];
    }
}
