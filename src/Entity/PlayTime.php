<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PlayTimeRepository")
 */
class PlayTime
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $minutes;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Footballer", inversedBy="id")
     * @ORM\JoinColumn(nullable=true)
     */
    private $footballer;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Team", inversedBy="id")
     * @ORM\JoinColumn(nullable=false)
     */
    private $club;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Matchs", inversedBy="id")
     * @ORM\JoinColumn(nullable=true)
     */
    private $match;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $yellowCard;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $redCard;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $play = 1;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

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


    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getFootballer()
    {
        return $this->footballer;
    }

    /**
     * @param mixed $footballer
     */
    public function setFootballer($footballer)
    {
        $this->footballer = $footballer;
    }

    /**
     * @return mixed
     */
    public function getClub()
    {
        return $this->club;
    }

    /**
     * @param mixed $club
     */
    public function setClub($club)
    {
        $this->club = $club;
    }

    /**
     * @return mixed
     */
    public function getMatch()
    {
        return $this->match;
    }

    /**
     * @param mixed $match
     */
    public function setMatch($match)
    {
        $this->match = $match;
    }

    /**
     * @return mixed
     */
    public function getYellowCard()
    {
        return $this->yellowCard;
    }

    /**
     * @param mixed $yellowCard
     */
    public function setYellowCard($yellowCard)
    {
        $this->yellowCard = $yellowCard;
    }

    /**
     * @return mixed
     */
    public function getRedCard()
    {
        return $this->redCard;
    }

    /**
     * @param mixed $redCard
     */
    public function setRedCard($redCard)
    {
        $this->redCard = $redCard;
    }

    /**
     * @return mixed
     */
    public function getPlay()
    {
        return $this->play;
    }

    /**
     * @param mixed $play
     */
    public function setPlay($play)
    {
        $this->play = $play;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }





}
