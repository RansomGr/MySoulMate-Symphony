<?php

namespace MySoulMate\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReclamationCompte
 *
 * @ORM\Table(name="reclamation_compte", indexes={@ORM\Index(name="fk_client", columns={"client"})})
 * @ORM\Entity
 */
class ReclamationCompte
{
    /**
     * @var string
     *
     * @ORM\Column(name="categorie", type="string", length=30, nullable=true)
     */
    private $categorie;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Dateheure", type="date", nullable=true)
     */
    private $dateheure;

    /**
     * @var \Client
     *
     * @ORM\ManyToOne(targetEntity="Client")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="client", referencedColumnName="entite")
     * })
     */
    private $client;

    /**
     * @var \Reclamation
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Reclamation")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="reclamation", referencedColumnName="ID")
     * })
     */
    private $reclamation;


}

