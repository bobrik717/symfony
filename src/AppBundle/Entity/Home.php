<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\HomeRepository")
 * @ORM\Table(name="home")
 */
class Home
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="string")
     */
    private $subFamaly;

    /**
     * @ORM\Column(type="integer")
     */
    private $speciesCount;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $note;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isPublished = true;

    /**
     * @ORM\OneToMany(targetEntity="HomeNotes", mappedBy="home")
     * @ORM\OrderBy({"createdAt" = "DESC"})
     */
    private $notes;

    public function __construct()
    {
        $this->notes = new ArrayCollection();
    }

    /**
     * @return boolean
     */
    public function getIsPublished()
    {
        return $this->isPublished;
    }

    /**
     * @param boolean $isPublished
     */
    public function setIsPublished($isPublished)
    {
        $this->isPublished = $isPublished;
    }

    /**
     * @return mixed
     */
    public function getSubFamaly()
    {
        return $this->subFamaly;
    }

    /**
     * @param mixed $subFamaly
     */
    public function setSubFamaly($subFamaly)
    {
        $this->subFamaly = $subFamaly;
    }

    /**
     * @return integer
     */
    public function getSpeciesCount()
    {
        return $this->speciesCount;
    }

    /**
     * @param integer $speciesCount
     */
    public function setSpeciesCount($speciesCount)
    {
        $this->speciesCount = $speciesCount;
    }

    /**
     * @return mixed
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * @param mixed $note
     */
    public function setNote($note)
    {
        $this->note = $note;
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

    public function getUpdatedAt()
    {
        return new \DateTime('-'.rand(0,100). ' days');
    }

    /**
     * @return ArrayCollection|HomeNotes[]
     */
    public function getNotes()
    {
        return $this->notes;
    }
}