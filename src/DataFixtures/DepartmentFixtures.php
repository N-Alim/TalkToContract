<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Department;

class DepartmentFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        for ($cnt=0; $cnt < 50; $cnt++) { 
            $department = new Department();
        
            $department->setName("department" . strval($cnt + 1));
            $department->setNumber($cnt + 1);
            
            $manager->persist($department);
        }


        $manager->flush();
    }
}
