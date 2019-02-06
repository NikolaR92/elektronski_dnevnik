<?php
/**
 * Created by PhpStorm.
 * User: nikola
 * Date: 28.1.19.
 * Time: 21.27
 */

namespace App\Repository;


use App\Entity\Cas;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * Class CasRepository
 * @package App\Repository
 *
 * @method Cas|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cas|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cas[]    findAll()
 * @method Cas[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CasRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cas::class);
    }
}