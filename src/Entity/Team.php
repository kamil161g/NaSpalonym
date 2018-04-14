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

    public function __construct()
    {
        $this->footballer = new ArrayCollection();
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
     * @param Team|null $division
     * @return $this
     */
    public function setDivision(Team $division = null)
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
     * @param Team|null $league
     * @return $this
     */
    public function setLeague(Team $league = null)
    {
        $this->league = $league;

        return $this;
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
        return $this->getLeague();
    }





}
