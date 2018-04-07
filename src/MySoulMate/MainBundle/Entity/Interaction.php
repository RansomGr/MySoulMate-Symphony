<?php

namespace MySoulMate\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Interaction
 *
 * @ORM\Table(name="interaction", indexes={@ORM\Index(name="fk_interaction_client", columns={"Client"}), @ORM\Index(name="fk_interaction_actualite", columns={"actualite"})})
 * @ORM\Entity
 */
class Interaction
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
     * @ORM\Column(name="commentaire", type="text", length=65535, nullable=true)
     */
    private $commentaire;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateheure", type="datetime", nullable=true)
     */
    private $dateheure;

    /**
     * @var \Actualite
     *
     * @ORM\ManyToOne(targetEntity="Actualite")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="actualite", referencedColumnName="ID")
     * })
     */
    private $actualite;

    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Client", referencedColumnName="id")
     * })
     */
    private $client;


}

