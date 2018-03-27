<?php

namespace MySoulMate\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ContenuMoment
 *
 * @ORM\Table(name="contenu_moment")
 * @ORM\Entity
 */
class ContenuMoment
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=30, nullable=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="string", length=50, nullable=true)
     */
    private $photo;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="text", length=65535, nullable=true)
     */
    private $contenu;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=true)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_moment", type="date", nullable=true)
     */
    private $dateMoment;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Relation", inversedBy="cMoment")
     * @ORM\JoinTable(name="moment",
     *   joinColumns={
     *     @ORM\JoinColumn(name="c_moment", referencedColumnName="ID")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="relation", referencedColumnName="ID")
     *   }
     * )
     */
    private $relation;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->relation = new \Doctrine\Common\Collections\ArrayCollection();
    }

}

