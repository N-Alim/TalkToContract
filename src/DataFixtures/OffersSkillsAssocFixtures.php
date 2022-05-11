<?php

namespace App\DataFixtures;

use App\Entity\OffersSkillsAssoc;
// use App\DataFixtures\ApiCallService;
use App\Service\ApiCallService
;
use App\Repository\OfferRepository;
use App\DataFixtures\OfferFixtures;
use App\DataFixtures\SkillFixtures;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;




class OffersSkillsAssocFixtures extends Fixture implements DependentFixtureInterface
{
    public const OFFER_SKILL_ASSOC_REFERENCE = 'offerSkillAssoc';

    private ApiCallService $apiCaller;
    private OfferRepository $offerRepo;

    public function __construct(ApiCallService $apiCaller, OfferRepository $offerRepo)
    {
        $this->apiCaller = $apiCaller;
        $this->offerRepo = $offerRepo;

    }

    public function load(ObjectManager $manager): void
    {
        foreach ($this->apiCaller->getAllJobsSkills() as $value) {

            $offersSkillsAssoc = new offersSkillsAssoc();
        
            // $offersSkillsAssoc->setOffer($this->offerRepo->findOneBy(['name'=> $value['racineCompetence']["libelle"]]));
            // ($this->getReference(OfferFixtures::OFFER_REFERENCE));
            // 
            
            $manager->persist($offersSkillsAssoc);
        }

        $manager->flush();

        $this->addReference(self::OFFER_SKILL_ASSOC_REFERENCE, $offersSkillsAssoc);
    }

    public function getDependencies()
    {
        return [
            OfferFixtures::class,
            SkillFixtures::class,
        ];
    }
}
