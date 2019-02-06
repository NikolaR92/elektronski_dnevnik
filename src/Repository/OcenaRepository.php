<?php
/**
 * Created by PhpStorm.
 * User: nikola
 * Date: 28.1.19.
 * Time: 21.23
 */

namespace App\Repository;


use App\Entity\Ocena;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * Class OcenaRepository
 * @package App\Repository
 *
 * @method Ocena|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ocena|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ocena[]    findAll()
 * @method Ocena[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OcenaRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ocena::class);
    }
}