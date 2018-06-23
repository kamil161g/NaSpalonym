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

    public function addUser($user, $pass, $key)
    {

        $em = $this->_em;
        $user->setPassword($pass);
        $user->setActivatekey($key);
        $em->persist($user);
        $em->flush();

    }

    public function changeActive($user)
    {

        $em = $this->_em;
        $user->setIsActive(true);
        $user->setActivatekey(NULL);
        $em->persist($user);
        $em->flush();

    }
}
