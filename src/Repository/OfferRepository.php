<?php

namespace App\Repository;

use App\Entity\Offer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\CategoryRepository;

/**
 * @extends ServiceEntityRepository<Offer>
 *
 * @method Offer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Offer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Offer[]    findAll()
 * @method Offer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OfferRepository extends ServiceEntityRepository
{
    private CategoryRepository $categoryRepository;

    public function __construct(ManagerRegistry $registry, CategoryRepository $categoryRepository)
    {
        parent::__construct($registry, Offer::class);
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Offer $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Offer $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return Offer[] Returns an array of Offer objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Offer
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function getOffersWithFilters(Request $request, $offersPerPage = 25) : array
    {
        $job_name = $request->query->get('job_name') ?? "";
        $week_hours_number_min = $request->query->get('week_hours_number_min') ?? "";
        $week_hours_number_max = $request->query->get('week_hours_number_max') ?? "";
        $town = $request->query->get('town') ?? "";
        $experience_min = $request->query->get('experience_min') ?? "";
        $experience_max = $request->query->get('experience_max') ?? "";
        $category_id = $request->query->get('category_id') ?? "";;
        $sub_category_id = $request->query->get('sub_category_id') ?? "";
        $offers_type_id = $request->query->get('offers_type_id') ?? "";
        $department_id = $request->query->get('department_id') ?? "";
        $pagination = $request->query->get('pagination') ?? 1;

        $queryBuilder = $this->createQueryBuilder('o');

        if ($job_name !== "")
        {            
            $queryBuilder->where('o.job_name LIKE ?1')
            ->setParameter(1, "%" . preg_replace("/\s+/", "%", $job_name) . "%");
        }

        if ($week_hours_number_min !== "" && $week_hours_number_max !== "")
        {         
            $queryBuilder->andWhere('o.week_hours_number BETWEEN ?2 AND ?3')
            ->setParameter(2, intval($week_hours_number_min))
            ->setParameter(3, intval($week_hours_number_max));
        }

        if ($town !== "")
        {            
            $queryBuilder->andWhere('o.town LIKE ?4')
            ->setParameter(4, "%" . preg_replace("/\s+/", "%", $town) . "%");
        }

        if ($experience_min !== "" && $experience_max !== "")
        {         
            $queryBuilder->andWhere('o.experience BETWEEN ?5 AND ?6')
            ->setParameter(5, intval($experience_min))
            ->setParameter(6, intval($experience_max));
        }

        if ($sub_category_id !== "")
        {
            $queryBuilder->andWhere('o.sub_category = ?7')
            ->setParameter(7, intval($sub_category_id));
        }

        else
        {
            if ($category_id !== "")
            {
                $subCategoriesId = $this->categoryRepository->getSubCategoriesIdArray(intval($category_id));

                $queryBuilder->andWhere('o.sub_category IN (?8)')
                ->setParameter(8, 
                $subCategoriesId, 
                    \Doctrine\DBAL\Connection::PARAM_INT_ARRAY);
            }
        }

        if ($offers_type_id !== "")
        {
            $queryBuilder->andWhere('o.offers_type = ?9')
            ->setParameter(9, intval($offers_type_id));
        }

        if ($department_id !== "")
        {
            $queryBuilder->andWhere('o.department = ?10')
            ->setParameter(10, intval($department_id));
        }

        $result = $queryBuilder->andWhere('o.active = true')
        ->orderBy('o.modified_at', 'DESC')
        ->setFirstResult($offersPerPage * (intval($pagination) - 1))
        ->setMaxResults($offersPerPage)
        ->getQuery()
        ->getResult();

        return $result;
    }
}
