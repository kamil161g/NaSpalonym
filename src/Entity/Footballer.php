<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FootballerRepository")
 */
class Footballer
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $surname;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $DateOfBirth;


    /**
     * @var InformationFb[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\InformationFb", mappedBy="footballer")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    private $footballer;

    /**
     * @var PlayTime[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\PlayTime", mappedBy="footballer")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    private $playTime;

    /**
     * @var Shooter[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Shooter", mappedBy="shooter")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    private $shooter;

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
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @param mixed $surname
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;
    }

    /**
     * @return mixed
     */
    public function getDateOfBirth()
    {
        return $this->DateOfBirth;
    }

    /**
     * @param mixed $DateOfBirth
     */
    public function setDateOfBirth($DateOfBirth)
    {
        $this->DateOfBirth = $DateOfBirth;
    }


    public function __construct()
    {
        $this->footballer = new ArrayCollection();
        $this->shooter = new ArrayCollection();
        $this->playTime = new ArrayCollection();
    }

    /**
     * @param InformationFb $informationFb
     * @return $this
     */
    public function setFootballer(InformationFb $informationFb)
    {
        $this->footballer[] = $informationFb;

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
     * @param Shooter $shooter
     * @return $this
     */
    public function setShooter(Shooter $shooter)
    {
        $this->shooter[] = $shooter;

        return $this;
    }

    /**
     * @return Shooter[]|ArrayCollection
     */
    public function getShooter()
    {
        return $this->shooter;
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
