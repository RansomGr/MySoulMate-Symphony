<?php

namespace MySoulMate\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Profil
 *
 * @ORM\Table(name="profil", indexes={@ORM\Index(name="fk_profil_pref2", columns={"preference"})})
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
     * @ORM\Column(type="string",nullable=true)
     * @Assert\NotBlank(message="Please, upload only images.")
     * @Assert\File(mimeTypes={ "image/jpeg","image/pjpeg","image/png"})
     */
    private $photo;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=true)
     */
    private $description;

    /**
     * Many Features have One Product.
     * @ORM\ManyToOne(targetEntity="MySoulMate\MainBundle\Entity\Caracteristique", inversedBy="profile")
     * @ORM\JoinColumn(name="caracteristique", referencedColumnName="ID")
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
     * One Cart has One Customer.
     * @ORM\OneToOne(targetEntity="MySoulMate\MainBundle\Entity\Utilisateur")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

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

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

}

