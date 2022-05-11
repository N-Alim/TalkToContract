<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Skill;
use App\Service\ApiCallService;


class SkillFixtures extends Fixture
{
    public const SKILL_REFERENCE = 'skill';
    private ApiCallService $apiCaller;

    public function __construct(ApiCallService $apiCaller)
    {
        $this->apiCaller = $apiCaller;
    }

    public function load(ObjectManager $manager): void
    {

        foreach ($this->apiCaller->getAllJobsSkills() as $value) {
            $skill = new Skill();
        
            $skill->setName($value["libelle"]);
            
            $manager->persist($skill);
        }

        $manager->flush();

        $this->addReference(self::SKILL_REFERENCE, $skill);
    }
        // for ($cnt=0; $cnt < 50; $cnt++) { 
        //     $skill = new Skill();
        //     $skill->setName("skill" . strval($cnt + 1));
        //     $manager->persist($skill);
        // }


        // $manager->flush();
        }
