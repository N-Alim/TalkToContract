<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\SubCategory;
use App\DataFixtures\CategoryFixtures;
use App\Service\ApiCallService;
use App\Repository\CategoryRepository;



class SubCategoryFixtures extends Fixture implements DependentFixtureInterface
{
      public const SUBCATEGORY_REFERENCE = 'subcategory';
      private CategoryRepository $categoryRepo;

    private ApiCallService $apiCaller;

    public function __construct(ApiCallService $apiCaller, CategoryRepository $categoryRepo)
    {
        $this->apiCaller = $apiCaller;
        $this->categoryRepo = $categoryRepo;

    }

    public function load(ObjectManager $manager): void
    {
        foreach ($this->apiCaller->getAllJobsSubCategories() as $value) {
            $subcategory = new SubCategory();
        
            $subcategory->setName($value["libelle"]);
            $subcategory->setCategory($this->categoryRepo->findOneBy(['name'=> $value['racineCompetence']["libelle"]]));
            
            $manager->persist($subcategory);
        }

        $manager->flush();

        $this->addReference(self::SUBCATEGORY_REFERENCE, $subcategory);

    }
     public function getDependencies()
            {
                sleep(1);
                return [
                    CategoryFixtures::class,
                ];
            }
}

