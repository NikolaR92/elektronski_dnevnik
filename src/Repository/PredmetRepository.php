<?php
/**
 * Created by PhpStorm.
 * User: nikola
 * Date: 28.1.19.
 * Time: 21.18
 */

namespace App\Repository;


use App\Entity\Nastavnik;
use App\Entity\Predmet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * Class PredmetRepository
 * @package App\Repository
 *
 * @method Predmet|null find($id, $lockMode = null, $lockVersion = null)
 * @method Predmet|null findOneBy(array $criteria, array $orderBy = null)
 * @method Predmet[]    findAll()
 * @method Predmet[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PredmetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Predmet::class);
    }
}