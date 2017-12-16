<?php

namespace App\Entity;

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
    private $start_match;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $end_match;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $goal_host_team;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $goal_guest_team;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $division;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $league;

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
        return $this->start_match;
    }

    /**
     * @param mixed $start_match
     */
    public function setStartMatch($start_match)
    {
        $this->start_match = $start_match;
    }

    /**
     * @return mixed
     */
    public function getEndMatch()
    {
        return $this->end_match;
    }

    /**
     * @param mixed $end_match
     */
    public function setEndMatch($end_match)
    {
        $this->end_match = $end_match;
    }

    /**
     * @return mixed
     */
    public function getGoalHostTeam()
    {
        return $this->goal_host_team;
    }

    /**
     * @param mixed $goal_host_team
     */
    public function setGoalHostTeam($goal_host_team)
    {
        $this->goal_host_team = $goal_host_team;
    }

    /**
     * @return mixed
     */
    public function getGoalGuestTeam()
    {
        return $this->goal_guest_team;
    }

    /**
     * @param mixed $goal_guest_team
     */
    public function setGoalGuestTeam($goal_guest_team)
    {
        $this->goal_guest_team = $goal_guest_team;
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

}
