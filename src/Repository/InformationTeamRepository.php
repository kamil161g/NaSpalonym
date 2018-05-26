<?php

namespace App\Repository;

use App\Entity\InformationTeam;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method InformationTeam|null find($id, $lockMode = null, $lockVersion = null)
 * @method InformationTeam|null findOneBy(array $criteria, array $orderBy = null)
 * @method InformationTeam[]    findAll()
 * @method InformationTeam[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InformationTeamRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, InformationTeam::class);
    }


    public function showTable($season, $league, $division)
    {

        $qb = $this->createQueryBuilder('p')
            ->innerJoin('p.club_id','a')
            ->andWhere('p.season = :season')
            ->andWhere('a.league = :league')
            ->andWhere('a.division = :division')
            ->addSelect('a')
            ->orderBy('p.points','DESC')
            ->setParameter('season', $season)
            ->setParameter('league', $league)
            ->setParameter('division', $division);

        return $qb->getQuery()->getArrayResult();

    }

    public function addPointsHost($detailsHost, $searchTime, $detailsGuest, $goalHost, $goalGuest)
    {
        $em = $this->_em;
        $detailsHost->setGoalsScored($detailsHost->getGoalsScored()+$goalHost);
        $detailsHost->setGoalsLost($detailsHost->getGoalsLost()+$goalGuest);
        $detailsHost->setPoints($detailsHost->getPoints()+3);
        $detailsHost->setMatchs($detailsHost->getMatchs()+1);
        $detailsGuest->setMatchs($detailsGuest->getMatchs()+1);
        $detailsHost->setWins($detailsHost->getWins()+1);
        $detailsGuest->setLost($detailsGuest->getLost()+1);
        $em->persist($detailsHost);
        $em->persist($detailsGuest);
        $em->flush();

    }

    public function addPointsGuest($detailsHost, $searchTime, $detailsGuest, $goalGuest, $goalHost)
    {
        $em = $this->_em;
        $detailsGuest->setGoalsScored($detailsGuest->getGoalsScored()+$goalGuest);
        $detailsGuest->setGoalsLost($detailsGuest->getGoalsLost()+$goalHost);
        $detailsGuest->setPoints($detailsGuest->getPoints()+3);
        $detailsGuest->setMatchs($detailsGuest->getMatchs()+1);
        $detailsHost->setMatchs($detailsHost->getMatchs()+1);
        $detailsGuest->setWins($detailsGuest->getWins()+1);
        $detailsHost->setLost($detailsGuest->getLost()+1);
        $em->persist($detailsHost);
        $em->persist($detailsGuest);
        $em->flush();

    }

    public function addDraw($detailsHost, $searchTime, $detailsGuest, $goalHost, $goalGuest)
    {
        $em = $this->_em;
        $detailsHost->setGoalsScored($detailsHost->getGoalsScored()+$goalHost);
        $detailsHost->setGoalsScored($detailsHost->getGoalsLost()+$goalGuest);
        $detailsHost->setPoints($detailsHost->getPoints()+1);
        $detailsHost->setMatchs($detailsHost->getMatchs()+1);
        $detailsHost->setDraw($detailsHost->getDraw()+1);

        $detailsGuest->setGoalsScored($detailsGuest->getGoalsScored()+$goalGuest);
        $detailsGuest->setGoalsScored($detailsGuest->getGoalsLost()+$goalHost);
        $detailsGuest->setPoints($detailsGuest->getPoints()+1);
        $detailsGuest->setMatchs($detailsGuest->getMatchs()+1);
        $detailsGuest->setDraw($detailsGuest->getDraw()+1);


        $em->persist($detailsHost);
        $em->persist($detailsGuest);
        $em->flush();

    }

}
