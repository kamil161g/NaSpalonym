<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TeamRepository")
 */
class Team
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $division;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $league;

    /**
     * @var InformationFb[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\InformationFb", mappedBy="club")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    private $footballer;

    /**
     * @var InformationTeam[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\InformationTeam", mappedBy="team")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    private $team;

    /**
     * @var PlayTime[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\PlayTime", mappedBy="club")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    private $playTime;



    public function __construct()
    {
        $this->footballer = new ArrayCollection();
        $this->team = new ArrayCollection();
        $this->playTime = new ArrayCollection();

    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getDivision()
    {
        return $this->division;
    }

    /**
     * @return $this
     */
    public function setDivision($division)
    {
        $this->division = $division;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLeague()
    {
        return $this->league;
    }

    /**
     * @return $this
     */
    public function setLeague($league)
    {
        $this->league = $league;

    }

    /**
     * @return InformationFb[]|ArrayCollection
     */
    public function getFootballer()
    {
        return $this->footballer;
    }

    /**
     * @param InformationFb $informationFb
     */
    public function setFootballer(InformationFb $informationFb)
    {
        $this->footballer = $informationFb;
    }

    function __toString() {
        return $this->getName();
    }


    /**
     * @param InformationTeam $informationTeam
     * @return $this
     */
    public function setTeam(InformationTeam $informationTeam)
    {
        $this->team[] = $informationTeam;

        return $this;
    }

    /**
     * @return InformationTeam[]|ArrayCollection
     */
    public function getTeam()
    {
        return $this->team;
    }

    /**
     * @return PlayTime[]|ArrayCollection
     */
    public function getPlayTime()
    {
        return $this->playTime;
    }

    /**
     * @param PlayTime[]|ArrayCollection $playTime
     */
    public function setPlayTime($playTime)
    {
        $this->playTime = $playTime;
    }


}
