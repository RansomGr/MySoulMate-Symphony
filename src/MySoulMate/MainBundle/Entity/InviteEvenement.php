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
     * @ORM\ManyToOne(targetEntity="Events",cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="evenement_groupe", referencedColumnName="id", onDelete="CASCADE")
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

    /**
     * InviteEvenement constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getParticipe()
    {
        return $this->participe;
    }

    /**
     * @param string $participe
     */
    public function setParticipe($participe)
    {
        $this->participe = $participe;
    }

    /**
     * @return \Events
     */
    public function getEvenementGroupe()
    {
        return $this->evenementGroupe;
    }

    /**
     * @param \Events $evenementGroupe
     */
    public function setEvenementGroupe($evenementGroupe)
    {
        $this->evenementGroupe = $evenementGroupe;
    }

    /**
     * @return \Utilisateur
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param \Utilisateur $client
     */
    public function setClient($client)
    {
        $this->client = $client;
    }


}

