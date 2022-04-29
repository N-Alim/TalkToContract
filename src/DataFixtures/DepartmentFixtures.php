<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Department;
use App\Service\ApiCallService;

class DepartmentFixtures extends Fixture
{
    private ApiCallService $apiCaller ;

    public function __construct(ApiCallService $apiCaller)
    {
        $this->apiCaller = $apiCaller;
    }

    public function load(ObjectManager $manager): void
    {
        foreach ($this->apiCaller->getAllDepartments() as $value) {
            $department = new Department();
        
            $department->setName($value["nom"]);
            $department->setNumber(intval($value["code"]));
            
            $manager->persist($department);
        }

        $manager->flush();
    }
}
