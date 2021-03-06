<?php

namespace RansomGr\PubliciteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert ;
/**
 * Publicite
 *
 * @ORM\Table(name="publicite")
 * @ORM\Entity(repositoryClass="RansomGr\PubliciteBundle\Repository\PubliciteRepository")
 */
class Publicite
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;
    /**
     * @var string
     * @Assert\Image()
     * @ORM\Column(name="lien", type="string", length=255)
     */

    private $photo;
    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="string", length=255)
     */
    private $lien;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_deb", type="date")
     */
    private $dateDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_fin", type="date")
     */
    private $dateFin;
    /**
     *  @var \PubOwner
     * @ORM\ManyToOne(targetEntity="PubOwner")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="owner", referencedColumnName="id")
     * })
     */
    private $owner;
    /**
     *  @var \PubPos
     * @ORM\ManyToOne(targetEntity="PubPos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="position", referencedColumnName="id")
     * })
     */
    private $position;

    /**
     * @var string
     *
     * @ORM\Column(name="approved", type="string")
     */
    private $approved;
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Publicite
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set photo
     *
     * @param string $photo
     *
     * @return Publicite
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * @return string
     */
    public function getLien()
    {
        return $this->lien;
    }

    /**
     * @param string $lien
     */
    public function setLien($lien)
    {
        $this->lien = $lien;
    }

    /**
     * Get photo
     *
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Publicite
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set dateDebut
     *
     * @param string $dateDebut
     *
     * @return Publicite
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return string
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * Set dateFin
     *
     * @param \DateTime $dateFin
     *
     * @return Publicite
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return \DateTime
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * @return \PubOwner
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * @param \PubOwner $owner
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;
    }

    /**
     * @return \PubPos
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param \PubPos $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }

    /**
     * @return string
     */
    public function getApproved()
    {
        return $this->approved;
    }

    /**
     * @param string $approved
     */
    public function setApproved($approved)
    {
        $this->approved = $approved;
    }

}

