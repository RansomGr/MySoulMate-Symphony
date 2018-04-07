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
     * @var \DateTime
     *
     * @ORM\Column(name="date_h", type="datetime", nullable=false)
     */
    private $dateH;

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
     * @return \DateTime
     */
    public function getDateH()
    {
        return $this->dateH;
    }

    /**
     * @param \DateTime $dateH
     */
    public function setDateH($dateH)
    {
        $this->dateH = $dateH;
    }

    /**
     * @return \Client
     */
    public function getClient1()
    {
        return $this->client1;
    }

    /**
     * @param \Client $client1
     */
    public function setClient1($client1)
    {
        $this->client1 = $client1;
    }

    /**
     * @return \Client
     */
    public function getClient2()
    {
        return $this->client2;
    }

    /**
     * @param \Client $client2
     */
    public function setClient2($client2)
    {
        $this->client2 = $client2;
    }


}

