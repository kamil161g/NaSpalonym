<?php

namespace App\Repository;

use App\Entity\Footballer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class FootballerRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Footballer::class);
    }

    public function searchId()
    {
        $qb = $this->createQueryBuilder('p')
            ->orderBy("p.id",'DESC')
            ->setMaxResults('1');

        return $qb->getQuery()->getOneOrNullResult();
    }


    public function addDetailsFootballer($footballer)
    {
        $em = $this->_em;
        $em->persist($footballer);
        $em->flush();
    }

    public function searchFootballer($name, $surname)
    {

        $qb = $this->createQueryBuilder('p')
            ->andWhere('p.name LIKE :name')
            ->andWhere('p.surname LIKE :surname')
            ->setParameter('name', '%'.$name.'%')
            ->setParameter('surname', '%'.$surname.'%');

        return $qb->getQuery()->getArrayResult();
    }

    public function lastAdd()
    {
        $qb = $this->createQueryBuilder('p')
            ->orderBy('p.id', 'DESC')
            ->setMaxResults('20');

        return $qb->getQuery()->getArrayResult();
    }

    public function findUser($id)
    {
        $qb = $this->createQueryBuilder('p')
            ->andWhere('p.id = :id')
            ->setParameter('id',$id);

        return $qb->getQuery()->getOneOrNullResult();

    }

    public function findFbForScore($id)
    {
        $qb = $this->createQueryBuilder('p')
            ->andWhere('p.id = :id')
            ->setParameter('id',$id);

        return $qb->getQuery()->getOneOrNullResult();
    }

}
