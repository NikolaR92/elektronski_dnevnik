<?php
/**
 * Created by PhpStorm.
 * User: nikola
 * Date: 28.1.19.
 * Time: 21.10
 */

namespace App\Repository;


use App\Entity\Nastavnik;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * Class NastavnikRepository
 * @package App\Repository
 *
 * @method Nastavnik|null find($id, $lockMode = null, $lockVersion = null)
 * @method Nastavnik|null findOneBy(array $criteria, array $orderBy = null)
 * @method Nastavnik[]    findAll()
 * @method Nastavnik[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NastavnikRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Nastavnik::class);
    }

}