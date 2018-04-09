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
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param string $photo
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return \Caracteristique
     */
    public function getCaracteristique()
    {
        return $this->caracteristique;
    }

    /**
     * @param \Caracteristique $caracteristique
     */
    public function setCaracteristique($caracteristique)
    {
        $this->caracteristique = $caracteristique;
    }

    /**
     * @return \Caracteristique
     */
    public function getPreference()
    {
        return $this->preference;
    }

    /**
     * @param \Caracteristique $preference
     */
    public function setPreference($preference)
    {
        $this->preference = $preference;
    }


}

