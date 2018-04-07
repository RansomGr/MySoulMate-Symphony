<?php

namespace MySoulMate\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InviteEvenement
 *
 * @ORM\Table(name="invite_evenement", indexes={@ORM\Index(name="IDX_9FF89C5BB74C5CA3", columns={"evenement_groupe"}), @ORM\Index(name="fk_invite_event", columns={"client"})})
 * @ORM\Entity
 */
class InviteEvenement
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
     * @ORM\Column(name="participe", type="string", length=3, nullable=false)
     */
    private $participe;

    /**
     * @var \Events
     *
     * @ORM\ManyToOne(targetEntity="Events")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="evenement_groupe", referencedColumnName="id")
     * })
     */
    private $evenementGroupe;

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

