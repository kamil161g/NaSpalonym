<?php

namespace App\Repository;

use App\Entity\InformationFb;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class InformationFbRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, InformationFb::class);
    }

    public function detailsFootballer($id)
    {
            $qb = $this->createQueryBuilder('p')
                ->innerJoin('p.footballer', 'c')
                ->addSelect('c')
                ->andWhere('p.footballer = :id')
                ->setParameter('id', $id);

            return $qb->getQuery()->getOneOrNullResult();

    }

    public function searchFootballer($id)
    {
        $qb = $this->createQueryBuilder('p')
            ->innerJoin('p.footballer', 'c')
            ->innerJoin('p.club', 't')
            ->addSelect('t')
            ->addSelect('c')
            ->andWhere('p.footballer = :id')
            ->setParameter('id', $id);

        return $qb->getQuery()->getArrayResult();

    }

    public function detailsForTeam($id)
    {
        $qb = $this->createQueryBuilder('p')
            ->innerJoin('p.club', 'c')
            ->innerJoin('p.footballer', 'd')
            ->addSelect('c')
            ->addSelect('d')
            ->andWhere('p.club = :id')
            ->setParameter('id', $id);

        return $qb->getQuery()->getArrayResult();

    }

    public function addDetails($details)
    {
        $em = $this->_em;
        $em->persist($details);
        $em->flush();
    }



}
