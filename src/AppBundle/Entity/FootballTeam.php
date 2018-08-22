<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="football_team")
 */
class FootballTeam
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;
    
	/**
     * @ORM\Column(type="string", length=255)
     */
    private $strip;

	/**
     * @ORM\Column(type="string", length=255)
     */
    private $football_leagueid;
	/**
     * Set strip
     *
     * @param string $strip
     */
    public function setStrip($strip)
    {
        $this->strip = $strip;
    }
    /**
     * Get strip
     *
     * @return string
     */
    public function getStrip()
    {
        return $this->strip;
    }

	/**
     * Set football_leagueid
     *
     * @param string $football_leagueid
     */
    public function setFootballLeagueid($football_leagueid)
    {
        $this->football_leagueid = $football_leagueid;
    }
    /**
     * Get football_leagueid
     *
     * @return string
     */
    public function getFootballLeagueid()
    {
        return $this->football_leagueid;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * Set name
     *
     * @param string $name
     *
     * @return Fruit
     */
    public function setName($name)
    {
        $this->name = $name;
    }
    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
    
