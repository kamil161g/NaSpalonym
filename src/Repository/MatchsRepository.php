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

    public function addMatch($match)
    {
        $entityManager = $this->_em;
        $entityManager->persist($match);
        $entityManager->flush();

    }



    public function findAllGreaterThanStart($start_match, $division): array
    {

        $qb = $this->createQueryBuilder('p')
            ->andWhere('p.start_match > :start_match')
            ->andWhere('p.division = :division')
            ->setParameter('start_match', $start_match)
            ->setParameter('division', $division)
            ->orderBy('p.start_match', 'ASC');


        return $qb->getQuery()->getArrayResult();

    }
}
