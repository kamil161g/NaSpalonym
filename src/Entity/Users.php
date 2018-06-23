<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UsersRepository")
 * @UniqueEntity("email", message="Ten Email jest już używany.")
 */
class Users implements AdvancedUserInterface, \Serializable
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $password;

    private $plainPassword;

    /**
     * @ORM\Column(type="string", length=254, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=254)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=254)
     */
    private $surname;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    /**
     * @ORM\Column(type="string", length=254)
     */
    private $roles = "ROLE_ADMIN";

    /**
     * @ORM\Column(type="string", length=254, nullable=true)
     */
    private $activatekey;

    /**
     * @var PlayTime[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\PlayTime", mappedBy="users")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    private $playtime;

    /**
     * @var Shooter[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Shooter", mappedBy="users")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    private $shooter;

    /**
     * @var Team[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Team", mappedBy="users")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    private $team;

    /**
     * @var Matchs[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Matchs", mappedBy="users")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    private $match;

    /**
     * @var InformationFb[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\InformationFb", mappedBy="users")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    private $infofb;

    /**
     * @var InformationTeam[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\InformationTeam", mappedBy="users")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    private $infoteam;

    /**
     * @var InformationTeam[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Footballer", mappedBy="users")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    private $footballer;

    /**
     * @var FileUpload[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\FileUpload", mappedBy="users")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    private $fileupload;


    public function __construct()
    {
        $this->isActive = false;
        $this->match = new ArrayCollection();
        $this->shooter = new ArrayCollection();
        $this->playtime = new ArrayCollection();
        $this->team = new ArrayCollection();
        $this->infofb = new ArrayCollection();
        $this->infoteam = new ArrayCollection();
        $this->footballer = new ArrayCollection();
        $this->fileupload = new ArrayCollection();
        // may not be needed, see section on salt below
        // $this->salt = md5(uniqid('', true));
    }

    public function getUsername()
    {
        return $this->email;
    }

    public function getSalt()
    {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getRoles()
    {
        return array($this->roles);
    }

    /**
     * @param mixed $roles
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;
    }


    public function eraseCredentials()
    {
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->email,
            $this->password,
            $this->name,
            $this->surname,
            $this->isActive
            // see section on salt below
            // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->email,
            $this->password,
            $this->name,
            $this->surname,
            $this->isActive
            // see section on salt below
            // $this->salt
            ) = unserialize($serialized, ['allowed_classes' => false]);
    }


    /**
     * @return mixed
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }
    /**
     * @param mixed $password
     */
    public function setPlainPassword($password)
    {
        $this->plainPassword = $password;
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
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getisActive()
    {
        return $this->isActive;
    }

    /**
     * @param mixed $isActive
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
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
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function isAccountNonExpired()
    {
        return true;
    }

    public function isAccountNonLocked()
    {
        return true;
    }

    public function isCredentialsNonExpired()
    {
        return true;
    }

    public function isEnabled()
    {
        return $this->isActive;
    }

    /**
     * @return mixed
     */
    public function getActivatekey()
    {
        return $this->activatekey;
    }

    /**
     * @param mixed $activatekey
     */
    public function setActivatekey($activatekey)
    {
        $this->activatekey = $activatekey;
    }

    /**
     * @return PlayTime[]|ArrayCollection
     */
    public function getPlaytime()
    {
        return $this->playtime;
    }

    /**
     * @param PlayTime[]|ArrayCollection $playtime
     */
    public function setPlaytime($playtime)
    {
        $this->playtime = $playtime;
    }

    /**
     * @return Shooter[]|ArrayCollection
     */
    public function getShooter()
    {
        return $this->shooter;
    }

    /**
     * @param Shooter[]|ArrayCollection $shooter
     */
    public function setShooter($shooter)
    {
        $this->shooter = $shooter;
    }

    /**
     * @return Team[]|ArrayCollection
     */
    public function getTeam()
    {
        return $this->team;
    }

    /**
     * @param Team[]|ArrayCollection $team
     */
    public function setTeam($team)
    {
        $this->team = $team;
    }

    /**
     * @return Matchs[]|ArrayCollection
     */
    public function getMatch()
    {
        return $this->match;
    }

    /**
     * @param Matchs[]|ArrayCollection $match
     */
    public function setMatch($match)
    {
        $this->match = $match;
    }

    /**
     * @return InformationFb[]|ArrayCollection
     */
    public function getInfofb()
    {
        return $this->infofb;
    }

    /**
     * @param InformationFb[]|ArrayCollection $infofb
     */
    public function setInfofb($infofb)
    {
        $this->infofb = $infofb;
    }

    /**
     * @return InformationTeam[]|ArrayCollection
     */
    public function getInfoteam()
    {
        return $this->infoteam;
    }

    /**
     * @param InformationTeam[]|ArrayCollection $infoteam
     */
    public function setInfoteam($infoteam)
    {
        $this->infoteam = $infoteam;
    }

    /**
     * @return InformationTeam[]|ArrayCollection
     */
    public function getFootballer()
    {
        return $this->footballer;
    }

    /**
     * @param InformationTeam[]|ArrayCollection $footballer
     */
    public function setFootballer($footballer)
    {
        $this->footballer = $footballer;
    }

    /**
     * @return FileUpload[]|ArrayCollection
     */
    public function getFileupload()
    {
        return $this->fileupload;
    }

    /**
     * @param FileUpload[]|ArrayCollection $fileupload
     */
    public function setFileupload($fileupload)
    {
        $this->fileupload = $fileupload;
    }





}
