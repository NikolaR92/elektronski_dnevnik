<?php
/**
 * Created by PhpStorm.
 * User: nikola
 * Date: 30.1.19.
 * Time: 11.15
 */

namespace App\Repository;


use App\Entity\Razredni;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * Class RazredniRepository
 * @package App\Repository
 *
 * @method Razredni|null find($id, $lockMode = null, $lockVersion = null)
 * @method Razredni|null findOneBy(array $criteria, array $orderBy = null)
 * @method Razredni[]    findAll()
 * @method Razredni[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RazredniRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Razredni::class);
    }
}