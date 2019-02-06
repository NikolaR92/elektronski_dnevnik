<?php
/**
 * Created by PhpStorm.
 * User: nikola
 * Date: 28.1.19.
 * Time: 21.43
 */

namespace App\Repository;


use App\Entity\Plan;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * Class PlanRespository
 * @package App\Repository
 *
 * @method Plan|null find($id, $lockMode = null, $lockVersion = null)
 * @method Plan|null findOneBy(array $criteria, array $orderBy = null)
 * @method Plan[]    findAll()
 * @method Plan[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlanRespository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Plan::class);
    }
}