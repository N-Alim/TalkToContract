<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Service\ApiCallService;

class CategoryFixtures extends Fixture
{

    public const CATEGORY_REFERENCE = 'category';

    private ApiCallService $apiCaller;

    public function __construct(ApiCallService $apiCaller)
    {
        $this->apiCaller = $apiCaller;
    }

    public function load(ObjectManager $manager): void
    {
        foreach ($this->apiCaller->getAllJobsCategories() as $value) {
            $category = new Category();
        
            $category->setName($value["libelle"]);
            
            $manager->persist($category);
        }
        
        $manager->flush();
        $this->addReference(self::CATEGORY_REFERENCE, $category);

    }
}
