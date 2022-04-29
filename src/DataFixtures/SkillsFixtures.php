<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Skills;

class SkillsFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        for ($cnt=0; $cnt < 50; $cnt++) { 
            $skills = new Skills();
            $skills->setName("skills" . strval($cnt + 1));
            $manager->persist($skills);
        }


        $manager->flush();
    }
}