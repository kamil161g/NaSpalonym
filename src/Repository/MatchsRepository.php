<?php

namespace App\Repository;

use App\Entity\Matchs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class MatchsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Matchs::class);
    }

    public function addMatch($match,$end)
    {
        $entityManager = $this->_em;
        $match->setEndMatch($end);
        $entityManager->persist($match);
        $entityManager->flush();

    }

    public function changeScore($id)
    {
        $qb = $this->createQueryBuilder('p')
            ->andWhere('p.id = :id')
            ->setParameter('id',$id);

        return $qb->getQuery()->getOneOrNullResult();
    }

    public function addGoals($match,$gh, $gg)
    {
        $entityManager = $this->_em;
        $match->setGoalHost($gh);
        $match->setGoalGuest($gg);
        $entityManager->persist($match);
        $entityManager->flush();

    }

    public function findAllGreaterThanStart($startMatch, $division): array
    {

        $qb = $this->createQueryBuilder('p')
            ->andWhere('p.startMatch > :startMatch')
            ->andWhere('p.division = :division')
            ->setParameter('startMatch', $startMatch)
            ->setParameter('division', $division)
            ->orderBy('p.startMatch', 'ASC');


        return $qb->getQuery()->getArrayResult();

    }

    public function findLiveMatchs($startMatch, $endMatch)
    {

        $qb = $this->createQueryBuilder('p')
            ->andWhere('p.startMatch <= :startMatch')
            ->andWhere('p.endMatch >= :endMatch')
            ->setParameter('startMatch', $startMatch)
            ->setParameter('endMatch', $endMatch);

        return $qb->getQuery()->getArrayResult();

    }

    public function showDetails($id)
    {
            $qb = $this->createQueryBuilder('p')
            ->andWhere('p.id = :id')
            ->setParameter('id', $id);

        return $qb->getQuery()->getArrayResult();

    }

    public function searchTeams($id)
    {
        $qb = $this->createQueryBuilder('p')
            ->andWhere('p.id = :id')
            ->setParameter('id',$id);

        return $qb->getQuery()->getOneOrNullResult();
    }

    public function addStatus($match)
    {

        $em = $this->_em;
        $match->setStatus("Examined");
        $em->persist($match);
        $em->flush();

    }

}
