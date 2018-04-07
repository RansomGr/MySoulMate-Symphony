<?php

namespace MySoulMate\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MentionJaime
 *
 * @ORM\Table(name="mention_jaime", indexes={@ORM\Index(name="IDX_2E95F80CC7440455", columns={"client"}), @ORM\Index(name="IDX_2E95F80C54928197", columns={"actualite"})})
 * @ORM\Entity
 */
class MentionJaime
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
     * @ORM\Column(name="jaime", type="string", length=3, nullable=false)
     */
    private $jaime;

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
     *   @ORM\JoinColumn(name="client", referencedColumnName="id")
     * })
     */
    private $client;


}

