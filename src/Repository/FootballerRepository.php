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


    public function addDetailsFootballer($footballer)
    {
        $em = $this->_em;
        $em->persist($footballer);
        $em->flush();
    }
}
