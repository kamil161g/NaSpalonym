<?php

namespace App\Repository;

use App\Entity\PlayTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PlayTime|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlayTime|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlayTime[]    findAll()
 * @method PlayTime[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlayTimeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PlayTime::class);
    }

    public function add($footballer, $club, $match, $playTime)
    {
        $em = $this->_em;
        $playTime->setFootballer($footballer);
        $playTime->setClub($club);
        $playTime->setMatch($match);
        $em->persist($playTime);
        $em->flush();
    }

    public function findSquad($club, $match)
    {
        $qb = $this->createQueryBuilder('p')
            ->innerJoin('p.footballer','a')
            ->addSelect('a')
            ->andWhere('p.club = :club')
            ->andWhere('p.match = :match')
            ->setParameter('club', $club)
            ->setParameter('match', $match);

        return $qb->getQuery()->getArrayResult();

    }

}
