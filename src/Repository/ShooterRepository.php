<?php

namespace App\Repository;

use App\Entity\Shooter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class ShooterRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Shooter::class);
    }

    public function addShooter($fb, $match, $minutes, $shooter)
    {
        $em = $this->_em;
        $shooter->setShooter($fb);
        $shooter->setMatch($match);
        $shooter->setMinutes($minutes);
        $shooter->setSeason(Shooter::NOW_SEASON);
        $em->persist($shooter);
        $em->flush();
    }

    public function deleteShooter($shooter)
    {
        $em = $this->_em;
        $em->remove($shooter);
        $em->flush();
    }

    public function showStats($season)
    {
        $qb = $this->createQueryBuilder('p')
            ->innerJoin('p.shooter','a')
            ->innerJoin('a.footballer','b')
            ->innerJoin('b.club', 'c')
            ->addSelect('a')
            ->addSelect('b')
            ->addSelect('c')
            ->andWhere('p.season = :season')
            ->setParameter('season',$season);

        return $qb->getQuery()->getArrayResult();
    }

    public function searchShooterHost($id, $match)
    {
        $qb = $this->createQueryBuilder('p')
            ->innerJoin('p.shooter','a')
            ->addSelect('p.shooter')
            ->andWhere('p.shooter = :id')
            ->andWhere('p.match = :match')
            ->setParameter('id', $id)
            ->setParameter('match', $match);

        return $qb->getQuery()->getArrayResult();
    }
}
