<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Skill;

class SkillFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        for ($cnt=0; $cnt < 50; $cnt++) { 
            $skill = new Skill();
            $skill->setName("skill" . strval($cnt + 1));
            $manager->persist($skill);
        }


        $manager->flush();
    }
}