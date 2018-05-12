<?php

namespace App\Repository;

use App\Entity\Users;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class UsersRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Users::class);
    }

    public function addUser($user, $pass)
    {

        $em = $this->_em;
        $em->persist($user);
        $user->setPassword($pass);
        $em->flush();

    }
}
