<?php

namespace App\Repository;

use App\Entity\InformationTeam;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method InformationTeam|null find($id, $lockMode = null, $lockVersion = null)
 * @method InformationTeam|null findOneBy(array $criteria, array $orderBy = null)
 * @method InformationTeam[]    findAll()
 * @method InformationTeam[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InformationTeamRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, InformationTeam::class);
    }


    public function showTable($season, $league, $division)
    {

        $qb = $this->createQueryBuilder('p')
            ->innerJoin('p.club_id','a')
            ->andWhere('p.season = :season')
            ->andWhere('a.league = :league')
            ->andWhere('a.division = :division')
            ->addSelect('a')
            ->setParameter('season', $season)
            ->setParameter('league', $league)
            ->setParameter('division', $division);

        return $qb->getQuery()->getArrayResult();

    }

}
