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


}
