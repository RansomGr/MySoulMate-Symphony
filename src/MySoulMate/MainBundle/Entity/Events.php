<?php

namespace MySoulMate\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Events
 *
 * @ORM\Table(name="events", indexes={@ORM\Index(name="fk_orga_client_evt", columns={"organisateur_evt"}), @ORM\Index(name="fk_plan_evt", columns={"plan_evt"})})
 * @ORM\Entity
 */
class Events
{
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
     * @var \Entite
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Entite")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Entite", referencedColumnName="ID")
     * })
     */
    private $entite;

    /**
     * @var \Client
     *
     * @ORM\ManyToOne(targetEntity="Client")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="organisateur_evt", referencedColumnName="entite")
     * })
     */
    private $organisateurEvt;

    /**
     * @var \Plan
     *
     * @ORM\ManyToOne(targetEntity="Plan")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="plan_evt", referencedColumnName="Entite")
     * })
     */
    private $planEvt;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Client", mappedBy="evenementGroupe")
     */
    private $client;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->client = new \Doctrine\Common\Collections\ArrayCollection();
    }

}

