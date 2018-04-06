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
     * @var \Client
     *
     * @ORM\ManyToOne(targetEntity="Client")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="client", referencedColumnName="entite")
     * })
     */
    private $client;

    /**
     * @var \Packaging
     *
     * @ORM\ManyToOne(targetEntity="Packaging")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="packaging", referencedColumnName="ID")
     * })
     */
    private $packaging;


}

