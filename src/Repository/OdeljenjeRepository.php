<?php
/**
 * Created by PhpStorm.
 * User: nikola
 * Date: 28.1.19.
 * Time: 21.33
 */

namespace App\Repository;


use App\Entity\Odeljenje;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * Class OdeljenjeRepository
 * @package App\Repository
 *
 * @method Odeljenje|null find($id, $lockMode = null, $lockVersion = null)
 * @method Odeljenje|null findOneBy(array $criteria, array $orderBy = null)
 * @method Odeljenje[]    findAll()
 * @method Odeljenje[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OdeljenjeRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Odeljenje::class);
    }
}