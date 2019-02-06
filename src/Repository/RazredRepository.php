<?php
/**
 * Created by PhpStorm.
 * User: nikola
 * Date: 28.1.19.
 * Time: 21.39
 */

namespace App\Repository;


use App\Entity\Razred;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * Class RazredRepository
 * @package App\Repository
 *
 * @method Razred|null find($id, $lockMode = null, $lockVersion = null)
 * @method Razred|null findOneBy(array $criteria, array $orderBy = null)
 * @method Razred[]    findAll()
 * @method Razred[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RazredRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Razred::class);
    }
}