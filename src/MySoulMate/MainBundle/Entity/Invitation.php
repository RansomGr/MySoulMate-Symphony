<?php

namespace MySoulMate\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Invitation
 *
 * @ORM\Table(name="invitation", indexes={@ORM\Index(name="IDX_F11D61A21135F72", columns={"client2"}), @ORM\Index(name="fk_client1_invit", columns={"client1"})})
 * @ORM\Entity
 */
class Invitation
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
     * @ORM\Column(name="statut", type="string", length=30, nullable=true)
     */
    private $statut;

    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="client2", referencedColumnName="id")
     * })
     */
    private $client2;

    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="client1", referencedColumnName="id")
     * })
     */
    private $client1;

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
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * @param string $statut
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;
    }

    /**
     * @return \Utilisateur
     */
    public function getClient2()
    {
        return $this->client2;
    }

    /**
     * @param \Utilisateur $client2
     */
    public function setClient2($client2)
    {
        $this->client2 = $client2;
    }

    /**
     * @return \Utilisateur
     */
    public function getClient1()
    {
        return $this->client1;
    }

    /**
     * @param \Utilisateur $client1
     */
    public function setClient1($client1)
    {
        $this->client1 = $client1;
    }


}

