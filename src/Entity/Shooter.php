<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ShooterRepository")
 */
class Shooter
{

    const NOW_SEASON = '2017/2018';
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
     * @ORM\Column(type="string", nullable=true)
     */
    private $season;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $minutes;

    /**
     * @var Footballer
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Footballer", inversedBy="shooter")
     */
    private $shooter;

    /**
     * @var Matchs
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Matchs", inversedBy="match")
     */
    private $match;

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
    public function getMinutes()
    {
        return $this->minutes;
    }

    /**
     * @param mixed $minutes
     */
    public function setMinutes($minutes)
    {
        $this->minutes = $minutes;
    }

    /**
     * @return Footballer
     */
    public function getShooter()
    {
        return $this->shooter;
    }

    /**
     * @param Footballer $footballer
     * @return $this
     */
    public function setShooter(Footballer $footballer)
    {
        $this->shooter = $footballer;

        return $this;
    }

    /**
     * @return Matchs
     */
    public function getMatch()
    {
        return $this->match;
    }

    /**
     * @param Matchs $matchs
     * @return $this
     */
    public function setMatch(Matchs $matchs)
    {
        $this->match = $matchs;

        return $this;
    }






}
