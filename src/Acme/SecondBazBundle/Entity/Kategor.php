<?php

namespace Acme\SecondBazBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Kategor
 *
 * @ORM\Table(name="kategor")
 * @ORM\Entity
 */
class Kategor
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=150, nullable=false)
     */
    private $name;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Acme\SecondBazBundle\Entity\Tovar", mappedBy="idkategor")
     */
    private $idtovar;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idtovar = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Kategor
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
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

    /**
     * Add idtovar
     *
     * @param \Acme\SecondBazBundle\Entity\Tovar $idtovar
     *
     * @return Kategor
     */
    public function addIdtovar(\Acme\SecondBazBundle\Entity\Tovar $idtovar)
    {
        $this->idtovar[] = $idtovar;

        return $this;
    }

    /**
     * Remove idtovar
     *
     * @param \Acme\SecondBazBundle\Entity\Tovar $idtovar
     */
    public function removeIdtovar(\Acme\SecondBazBundle\Entity\Tovar $idtovar)
    {
        $this->idtovar->removeElement($idtovar);
    }

    /**
     * Get idtovar
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdtovar()
    {
        return $this->idtovar;
    }

    
    function __toString()
    {
      return $this->getName();
    }

}
