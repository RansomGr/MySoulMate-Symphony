<?php

namespace MySoulMate\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ContenuMoment
 *
 * @ORM\Table(name="contenu_moment")
 * @ORM\Entity
 */
class ContenuMoment
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=30, nullable=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="string", length=50, nullable=true)
     */
    private $photo;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="text", length=65535, nullable=true)
     */
    private $contenu;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=true)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_moment", type="date", nullable=true)
     */
    private $dateMoment;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Relation", inversedBy="cMoment")
     * @ORM\JoinTable(name="moment",
     *   joinColumns={
     *     @ORM\JoinColumn(name="c_moment", referencedColumnName="ID")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="relation", referencedColumnName="ID")
     *   }
     * )
     */
    private $relation;

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
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
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
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * @param string $contenu
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
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
     * @return \DateTime
     */
    public function getDateMoment()
    {
        return $this->dateMoment;
    }

    /**
     * @param \DateTime $dateMoment
     */
    public function setDateMoment($dateMoment)
    {
        $this->dateMoment = $dateMoment;
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRelation()
    {
        return $this->relation;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection $relation
     */
    public function setRelation($relation)
    {
        $this->relation = $relation;
    }

    /**
     * Constructor
     */

    public function __construct()
    {
        $this->relation = new \Doctrine\Common\Collections\ArrayCollection();
    }

}

