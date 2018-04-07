<?php

namespace MySoulMate\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;


/**
 * Client
 *
 * @ORM\Table(name="client", indexes={@ORM\Index(name="fk_client_profil", columns={"profil"})})
 * @ORM\Entity
 */
class Client
{
    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=30, nullable=true)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="motdepasse", type="string", length=50, nullable=true)
     */
    private $motdepasse;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=50, nullable=true)
     */
    private $email;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_naissane", type="date", nullable=true)
     */
    private $dateNaissane;

    /**
     * @var string
     *
     * @ORM\Column(name="pseudo", type="string", length=30, nullable=true)
     */
    private $pseudo;

    /**
     * @var integer
     *
     * @ORM\Column(name="activation", type="integer", nullable=false)
     */
    private $activation = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="ban", type="integer", nullable=false)
     */
    private $ban = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="gender", type="string", length=20, nullable=false)
     */
    private $gender;

    /**
     * @var \Profil
     *
     * @ORM\ManyToOne(targetEntity="Profil")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="profil", referencedColumnName="id")
     * })
     */
    private $profil;

    /**
     * @var \Entite
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Entite")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="entite", referencedColumnName="ID")
     * })
     */
    private $entite;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Packaging", inversedBy="client")
     * @ORM\JoinTable(name="achat_packaging",
     *   joinColumns={
     *     @ORM\JoinColumn(name="client", referencedColumnName="entite")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="packaging", referencedColumnName="ID")
     *   }
     * )
     */
    private $packaging;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Plan", inversedBy="client")
     * @ORM\JoinTable(name="avis",
     *   joinColumns={
     *     @ORM\JoinColumn(name="client", referencedColumnName="entite")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="plan", referencedColumnName="Entite")
     *   }
     * )
     */
    private $plan;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Client", inversedBy="client1")
     * @ORM\JoinTable(name="invitation",
     *   joinColumns={
     *     @ORM\JoinColumn(name="client1", referencedColumnName="entite")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="client2", referencedColumnName="entite")
     *   }
     * )
     */
    private $client2;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Events", inversedBy="client")
     * @ORM\JoinTable(name="invite_evenement",
     *   joinColumns={
     *     @ORM\JoinColumn(name="client", referencedColumnName="entite")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="evenement_groupe", referencedColumnName="Entite")
     *   }
     * )
     */
    private $evenementGroupe;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Actualite", inversedBy="client")
     * @ORM\JoinTable(name="mention_jaime",
     *   joinColumns={
     *     @ORM\JoinColumn(name="client", referencedColumnName="entite")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="actualite", referencedColumnName="ID")
     *   }
     * )
     */
    private $actualite;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->packaging = new \Doctrine\Common\Collections\ArrayCollection();
        $this->plan = new \Doctrine\Common\Collections\ArrayCollection();
        $this->client2 = new \Doctrine\Common\Collections\ArrayCollection();
        $this->evenementGroupe = new \Doctrine\Common\Collections\ArrayCollection();
        $this->actualite = new \Doctrine\Common\Collections\ArrayCollection();
    }

}

