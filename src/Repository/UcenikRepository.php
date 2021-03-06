<?php
/**
 * Created by PhpStorm.
 * User: nikola
 * Date: 28.1.19.
 * Time: 20.51
 */

namespace App\Repository;

use App\Entity\Ucenik;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * Class UcenikRepository
 * @package App\Repository
 *
 * @method Ucenik|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ucenik|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ucenik[]    findAll()
 * @method Ucenik[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UcenikRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ucenik::class);
    }
}