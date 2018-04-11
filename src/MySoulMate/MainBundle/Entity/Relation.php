<?php

namespace MySoulMate\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Relation
 *
 * @ORM\Table(name="relation", indexes={@ORM\Index(name="fk_rel_client1", columns={"client1"}), @ORM\Index(name="fk_rel_client2", columns={"client2"})})
 * @ORM\Entity
 */
class Relation
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
     * @var \DateTime
     *
     * @ORM\Column(name="date_debut", type="date", nullable=true)
     */
    private $dateDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_fin", type="date", nullable=true)
     */
    private $dateFin;

    /**
     * @var integer
     *
     * @ORM\Column(name="niveau", type="integer", nullable=true)
     */
    private $niveau;

    /**
     * @var integer
     *
     * @ORM\Column(name="point_relation", type="integer", nullable=true)
     */
    private $pointRelation;

    /**
     * @var Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     *   @ORM\JoinColumn(name="client1", referencedColumnName="id",onDelete="CASCADE")
     * })
     */
    private $conjoint1;

    /**
     * @var Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     *   @ORM\JoinColumn(name="client2", referencedColumnName="id",onDelete="CASCADE")
     * })
     */
    private $conjoint2;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="ContenuMoment", mappedBy="relation")
     */
    private $cMoment;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return \DateTime
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * @param \DateTime $dateDebut
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;
    }

    /**
     * @return \DateTime
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * @param \DateTime $dateFin
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;
    }

    /**
     * @return int
     */
    public function getNiveau()
    {
        return $this->niveau;
    }

    /**
     * @param int $niveau
     */
    public function setNiveau($niveau)
    {
        $this->niveau = $niveau;
    }

    /**
     * @return int
     */
    public function getPointRelation()
    {
        return $this->pointRelation;
    }

    /**
     * @param int $pointRelation
     */
    public function setPointRelation($pointRelation)
    {
        $this->pointRelation = $pointRelation;
    }

    /**
     * @return mixed
     */
    public function getConjointt1()
    {
        return $this->conjoint1;
    }

    /**
     * @param mixed $conjoint1
     */
    public function setConjoint1($conjoint1)
    {
        $this->conjoint1 = $conjoint1;
    }

    /**
     * @return mixed
     */
    public function getConjoint2()
    {
        return $this->conjoint2;
    }

    /**
     * @param mixed $conjoint2
     */
    public function setClient2($conjoint2)
    {
        $this->conjoint2 = $conjoint2;
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCMoment()
    {
        return $this->cMoment;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection $cMoment
     */
    public function setCMoment($cMoment)
    {
        $this->cMoment = $cMoment;
    }

    /**
     * Constructor
     */

    public function __construct()
    {
        $this->cMoment = new \Doctrine\Common\Collections\ArrayCollection();
    }

}

