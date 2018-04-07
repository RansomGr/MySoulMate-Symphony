<?php

namespace MySoulMate\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Profil
 *
 * @ORM\Table(name="profil", indexes={@ORM\Index(name="fk_profil_carac", columns={"caracteristique"}), @ORM\Index(name="fk_profil_pref2", columns={"preference"})})
 * @ORM\Entity
 */
class Profil
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
     * @ORM\Column(name="photo", type="string", length=300, nullable=true)
     */
    private $photo;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=true)
     */
    private $description;

    /**
     * @var \Caracteristique
     *
     * @ORM\ManyToOne(targetEntity="Caracteristique")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="caracteristique", referencedColumnName="ID")
     * })
     */
    private $caracteristique;

    /**
     * @var \Caracteristique
     *
     * @ORM\ManyToOne(targetEntity="Caracteristique")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="preference", referencedColumnName="ID")
     * })
     */
    private $preference;


}

