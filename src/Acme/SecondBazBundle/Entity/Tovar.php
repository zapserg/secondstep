<?php

namespace Acme\SecondBazBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tovar
 *
 * @ORM\Table(name="tovar")
 * @ORM\Entity
 */
class Tovar
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
     * @ORM\Column(name="name", type="string", length=100, nullable=false)
     */
    private $name;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Acme\SecondBazBundle\Entity\Kategor", inversedBy="idtovar")
     * @ORM\JoinTable(name="svaz",
     *   joinColumns={
     *     @ORM\JoinColumn(name="idTovar", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="idKategor", referencedColumnName="id")
     *   }
     * )
     */
    private $idkategor;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idkategor = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Tovar
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
     * Add idkategor
     *
     * @param \Acme\SecondBazBundle\Entity\Kategor $idkategor
     *
     * @return Tovar
     */
    public function addIdkategor(\Acme\SecondBazBundle\Entity\Kategor $idkategor)
    {
        $this->idkategor[] = $idkategor;

        return $this;
    }

    /**
     * Remove idkategor
     *
     * @param \Acme\SecondBazBundle\Entity\Kategor $idkategor
     */
    public function removeIdkategor(\Acme\SecondBazBundle\Entity\Kategor $idkategor)
    {
        $this->idkategor->removeElement($idkategor);
    }

    /**
     * Get idkategor
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdkategor()
    {
        return $this->idkategor;
    }

    function __toString()
    {
      return $this->getName();
    }
    
}
