<?php

namespace App\Repository;

use App\Entity\Team;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class TeamRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Team::class);
    }

    public function searchTeam($name)
    {

        $qb = $this->createQueryBuilder('p')
            ->andWhere('p.name LIKE :name')
            ->setParameter('name', '%'.$name.'%');

        return $qb->getQuery()->getArrayResult();
    }

    public function detailsTeam($id)
    {

        $qb = $this->createQueryBuilder('p')
            ->andWhere('p.id = :id')
            ->setParameter('id', $id);

        return $qb->getQuery()->getOneOrNullResult();

    }

    public function searchId($name)
    {

        $qb = $this->createQueryBuilder('p')
            ->andWhere('p.name = :name')
            ->setParameter('name', $name);

        return $qb->getQuery()->getOneOrNullResult();
    }

    public function addDetailsTeam($team)
    {
        $em = $this->_em;
        $em->persist($team);
        $em->flush();
    }

    public function serachAndOrder()
    {
        $qb = $this->createQueryBuilder('p')
            ->orderBy("p.id",'DESC')
            ->setMaxResults('1');

        return $qb->getQuery()->getOneOrNullResult();
    }


}
