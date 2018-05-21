<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InformationFbRepository")
 */
class InformationFb
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @var Team
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Team", inversedBy="footballer")
     */
    private $club;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $season;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $goals;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $matchs;
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $position;

    /**
     * @var Footballer
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Footballer", inversedBy="footballer")
     *
     */
    private $footballer;


    private $plainSeason;

    /**
     * @return mixed
     */
    public function getPlainSeason()
    {
        return $this->plainSeason;
    }

    /**
     * @param mixed $season
     */
    public function setPlainSeason($season)
    {
        $this->plainSeason = $season;
    }

    


    /**
     * @return mixed
     */
    public function getSeason()
    {
        return $this->season;
    }

    /**
     * @param mixed $season
     */
    public function setSeason($season)
    {
        $this->season = $season;
    }

    /**
     * @return mixed
     */
    public function getGoals()
    {
        return $this->goals;
    }

    /**
     * @param mixed $goals
     */
    public function setGoals($goals)
    {
        $this->goals = $goals;
    }

    /**
     * @return mixed
     */
    public function getMatchs()
    {
        return $this->matchs;
    }

    /**
     * @param mixed $matchs
     */
    public function setMatchs($matchs)
    {
        $this->matchs = $matchs;
    }

    /**
     * @return mixed
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param mixed $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }


    /**
     * @return Footballer
     */
    public function getFootballer()
    {
        return $this->footballer;
    }

    /**
     * @param Footballer $footballers
     * @return $this
     */
    public function setFootballer(Footballer $footballers)
    {
        $this->footballer = $footballers;

        return $this;
    }

    /**
     * @return Team
     */
    public function getClub()
    {
        return $this->club;
    }

    /**
     * @param Team $team
     * @return $this
     */
    public function setClub(Team $team)
    {
        $this->club = $team;

        return $this;
    }





}
