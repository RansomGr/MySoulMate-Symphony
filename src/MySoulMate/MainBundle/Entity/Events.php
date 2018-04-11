<?php

namespace MySoulMate\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use MySoulMate\MainBundle\Entity\Plan;
use MySoulMate\MainBundle\Entity\Utilisateur;

/**
 * Events
 *
 * @ORM\Table(name="events", indexes={@ORM\Index(name="fk_orga_client_evt", columns={"organisateur_evt"}), @ORM\Index(name="fk_plan_evt", columns={"plan_evt"})})
 * @ORM\Entity(repositoryClass="MySoulMate\MainBundle\Repository\EventsRepository")
 */
class Events
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_evt", type="string", length=50, nullable=false)
     */
    private $nomEvt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_evt", type="date", nullable=false)
     */
    private $dateEvt;

    /**
     * @var string
     *
     * @ORM\Column(name="heure", type="string", length=20, nullable=false)
     */
    private $heure;

    /**
     * @var string
     *
     * @ORM\Column(name="duree_evt", type="string", length=20, nullable=false)
     */
    private $dureeEvt;

    /**
     * @var string
     *
     * @ORM\Column(name="type_evt", type="string", length=20, nullable=false)
     */
    private $typeEvt;

    /**
     * @var string
     *
     * @ORM\Column(name="description_evt", type="text", length=65535, nullable=false)
     */
    private $descriptionEvt;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_max", type="integer", nullable=false)
     */
    private $nbMax;

    /**
     * @var \Plan
     *
     * @ORM\ManyToOne(targetEntity="Plan")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="plan_evt", referencedColumnName="id")
     * })
     */
    private $planEvt;

    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="organisateur_evt", referencedColumnName="id")
     * })
     */
    private $organisateurEvt;

    /**
     * Events constructor.
     */
    public function __construct()
    {
    }

    /**
     * Events constructor.
     * @param int $id
     * @param string $nomEvt
     * @param \DateTime $dateEvt
     * @param string $heure
     * @param string $dureeEvt
     * @param string $typeEvt
     * @param string $descriptionEvt
     * @param int $nbMax
     * @param \Plan $planEvt
     * @param \Utilisateur $organisateurEvt
     */


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
     * @return string
     */
    public function getNomEvt()
    {
        return $this->nomEvt;
    }

    /**
     * @param string $nomEvt
     */
    public function setNomEvt($nomEvt)
    {
        $this->nomEvt = $nomEvt;
    }

    /**
     * @return \DateTime
     */
    public function getDateEvt()
    {
        return $this->dateEvt;
    }

    /**
     * @param \DateTime $dateEvt
     */
    public function setDateEvt($dateEvt)
    {
        $this->dateEvt = $dateEvt;
    }

    /**
     * @return string
     */
    public function getHeure()
    {
        return $this->heure;
    }

    /**
     * @param string $heure
     */
    public function setHeure($heure)
    {
        $this->heure = $heure;
    }

    /**
     * @return string
     */
    public function getDureeEvt()
    {
        return $this->dureeEvt;
    }

    /**
     * @param string $dureeEvt
     */
    public function setDureeEvt($dureeEvt)
    {
        $this->dureeEvt = $dureeEvt;
    }

    /**
     * @return string
     */
    public function getTypeEvt()
    {
        return $this->typeEvt;
    }

    /**
     * @param string $typeEvt
     */
    public function setTypeEvt($typeEvt)
    {
        $this->typeEvt = $typeEvt;
    }

    /**
     * @return string
     */
    public function getDescriptionEvt()
    {
        return $this->descriptionEvt;
    }

    /**
     * @param string $descriptionEvt
     */
    public function setDescriptionEvt($descriptionEvt)
    {
        $this->descriptionEvt = $descriptionEvt;
    }

    /**
     * @return int
     */
    public function getNbMax()
    {
        return $this->nbMax;
    }

    /**
     * @param int $nbMax
     */
    public function setNbMax($nbMax)
    {
        $this->nbMax = $nbMax;
    }

    /**
     * @return \Plan
     */
    public function getPlanEvt()
    {
        return $this->planEvt;
    }

    /**
     * @param \Plan $planEvt
     */
    public function setPlanEvt($planEvt)
    {
        $this->planEvt = $planEvt;
    }

    /**
     * @return \Utilisateur
     */
    public function getOrganisateurEvt()
    {
        return $this->organisateurEvt;
    }

    /**
     * @param \Utilisateur $organisateurEvt
     */
    public function setOrganisateurEvt($organisateurEvt)
    {
        $this->organisateurEvt = $organisateurEvt;
    }


}

