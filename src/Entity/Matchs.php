<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MatchsRepository")
 */
class Matchs
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    // add your own fields

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $hostTeam;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $guestTeam;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $startMatch;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $endMatch;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $goalHost;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $goalGuest;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $division;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $league;

    /**
     * @var Shooter[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Shooter", mappedBy="match")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    private $match;


    public function __construct()
    {
        $this->match = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getHostTeam()
    {
        return $this->hostTeam;
    }

    /**
     * @param mixed $hostTeam
     */
    public function setHostTeam($hostTeam)
    {
        $this->hostTeam = $hostTeam;
    }

    /**
     * @return mixed
     */
    public function getGuestTeam()
    {
        return $this->guestTeam;
    }

    /**
     * @param mixed $guestTeam
     */
    public function setGuestTeam($guestTeam)
    {
        $this->guestTeam = $guestTeam;
    }

    /**
     * @return mixed
     */
    public function getStartMatch()
    {
        return $this->startMatch;
    }

    /**
     * @param mixed $startMatch
     */
    public function setStartMatch($startMatch)
    {
        $this->startMatch = $startMatch;
    }

    /**
     * @return mixed
     */
    public function getEndMatch()
    {
        return $this->endMatch;
    }

    /**
     * @param mixed $endMatch
     */
    public function setEndMatch($endMatch)
    {
        $this->endMatch = $endMatch;
    }

    /**
     * @return mixed
     */
    public function getGoalHost()
    {
        return $this->goalHost;
    }

    /**
     * @param mixed $goalHost
     */
    public function setGoalHost($goalHost)
    {
        $this->goalHost = $goalHost;
    }

    /**
     * @return mixed
     */
    public function getGoalGuest()
    {
        return $this->goalGuest;
    }

    /**
     * @param mixed $goalGuest
     */
    public function setGoalGuest($goalGuest)
    {
        $this->goalGuest = $goalGuest;
    }

    /**
     * @return mixed
     */
    public function getDivision()
    {
        return $this->division;
    }

    /**
     * @param mixed $division
     */
    public function setDivision($division)
    {
        $this->division = $division;
    }

    /**
     * @return mixed
     */
    public function getLeague()
    {
        return $this->league;
    }

    /**
     * @param mixed $league
     */
    public function setLeague($league)
    {
        $this->league = $league;
    }

    /**
     * @return Shooter[]|ArrayCollection
     */
    public function getMatch()
    {
        return $this->match;
    }

    /**
     * @param Shooter[]|ArrayCollection $match
     */
    public function setMatch($match)
    {
        $this->match = $match;
    }





}
