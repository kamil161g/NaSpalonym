<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InformationTeamRepository")
 */
class InformationTeam
{
    const SEASONNOW = "2017/2018";

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $season;

    /**
     * @ORM\Column(type="integer")
     */
    private $matchs;

    /**
     * @ORM\Column(type="integer")
     */
    private $goalsScored;

    /**
     * @ORM\Column(type="integer")
     */
    private $goalsLost;

    /**
     * @ORM\Column(type="integer")
     */
    private $wins;

    /**
     * @ORM\Column(type="integer")
     */
    private $lost;

    /**
     * @ORM\Column(type="integer")
     */
    private $draw;

    /**
     * @var Footballer
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Team", inversedBy="team")
     *
     */
    private $team;

    /**
     * @ORM\Column(type="integer")
     */
    private $points;

    private $plainSeason;

    /**
     * @return mixed
     */
    public function getPlainSeason()
    {
        return $this->plainSeason;
    }

    /**
     * @param mixed $plainSeason
     */
    public function setPlainSeason($plainSeason)
    {
        $this->plainSeason = $plainSeason;
    }


    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $brochure;

    public function getBrochure()
    {
        return $this->brochure;
    }

    public function setBrochure($brochure)
    {
        $this->brochure = $brochure;

        return $this;
    }

    public function __construct()
    {
        $this->club_id = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getSeason(): ?string
    {
        return $this->season;
    }

    public function setSeason(string $season): self
    {
        $this->season = $season;

        return $this;
    }

    public function getMatchs(): ?int
    {
        return $this->matchs;
    }

    public function setMatchs(int $matchs): self
    {
        $this->matchs = $matchs;

        return $this;
    }

    public function getGoalsScored(): ?int
    {
        return $this->goalsScored;
    }

    public function setGoalsScored(int $goalsScored): self
    {
        $this->goalsScored = $goalsScored;

        return $this;
    }

    public function getGoalsLost(): ?int
    {
        return $this->goalsLost;
    }

    public function setGoalsLost(int $goalsLost): self
    {
        $this->goalsLost = $goalsLost;

        return $this;
    }


    /**
     * @return mixed
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * @param mixed $points
     */
    public function setPoints($points)
    {
        $this->points = $points;
    }

    /**
     * @return mixed
     */
    public function getWins()
    {
        return $this->wins;
    }

    /**
     * @param mixed $wins
     */
    public function setWins($wins)
    {
        $this->wins = $wins;
    }

    /**
     * @return mixed
     */
    public function getLost()
    {
        return $this->lost;
    }

    /**
     * @param mixed $lost
     */
    public function setLost($lost)
    {
        $this->lost = $lost;
    }

    /**
     * @return mixed
     */
    public function getDraw()
    {
        return $this->draw;
    }

    /**
     * @param mixed $draw
     */
    public function setDraw($draw)
    {
        $this->draw = $draw;
    }

    /**
     * @return Team
     */
    public function getTeam()
    {
        return $this->team;
    }

    /**
     * @param Team $team
     * @return $this
     */
    public function setTeam(Team $team)
    {
        $this->team = $team;

        return $this;
    }






}
