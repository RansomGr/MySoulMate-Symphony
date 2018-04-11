<?php

namespace MySoulMate\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AchatPackaging
 *
 * @ORM\Table(name="achat_packaging", indexes={@ORM\Index(name="IDX_64CBFBD5BF8B0D85", columns={"packaging"}), @ORM\Index(name="pk_client_pack", columns={"client"})})
 * @ORM\Entity
 */
class AchatPackaging
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
     * @var \Packaging
     *
     * @ORM\ManyToOne(targetEntity="Packaging")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="packaging", referencedColumnName="ID")
     * })
     */
    private $packaging;

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
     * @return \Packaging
     */
    public function getPackaging()
    {
        return $this->packaging;
    }

    /**
     * @param \Packaging $packaging
     */
    public function setPackaging($packaging)
    {
        $this->packaging = $packaging;
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

