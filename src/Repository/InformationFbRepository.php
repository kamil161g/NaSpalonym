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

    public function addDetailsFb($informationFb, $club, $footballer)
    {
        $em = $this->_em;
        $informationFb->setFootballer($footballer);
        $informationFb->setClub($club);
        $em->persist($informationFb);
        $em->flush();
    }

    public function detailsFootballer($id, $season)
    {
            $qb = $this->createQueryBuilder('p')
                ->innerJoin('p.footballer', 'c')
                ->addSelect('c')
                ->andWhere('p.footballer = :id')
                ->andWhere('p.season = :season')
                ->setParameter('id', $id)
                ->setParameter('season', $season);

            return $qb->getQuery()->getOneOrNullResult();

    }

    public function searchFootballerForSearching($id)
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

    public function searchFootballer($id, $division, $league)
    {
        $qb = $this->createQueryBuilder('p')
            ->innerJoin('p.footballer', 'c')
            ->innerJoin('p.club', 't')
            ->addSelect('t')
            ->addSelect('c')
            ->andWhere('p.season = :id')
            ->andWhere('t.division = :division')
            ->andWhere('t.league = :league')
            ->andWhere('p.goals > 0')
            ->orderBy('p.goals','DESC')
            ->setParameter('id', $id)
            ->setParameter('division', $division)
            ->setParameter('league', $league);

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


    public function searchFb($id, $season)
    {
        $qb = $this->createQueryBuilder('p')
            ->andWhere('p.footballer = :id')
            ->andWhere('p.season = :season')
            ->setParameter('id', $id)
            ->setParameter('season', $season);

        return $qb->getQuery()->getOneOrNullResult();
    }

    public function searchFbDefault($id, $season)
    {
        $qb = $this->createQueryBuilder('p')
            ->andWhere('p.footballer = :id')
            ->andWhere('p.season = :season')
            ->setParameter('id', $id)
            ->setParameter('season', $season);

        return $qb->getQuery()->getOneOrNullResult();
    }



}
