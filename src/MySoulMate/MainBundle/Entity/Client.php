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
class Client extends  BaseUser
{
    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=50, nullable=false)
     */
    private $nom;
    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=50, nullable=false)
     */
    private $prenom
    ;
    /**
     * @var string
     *
     * @ORM\Column(name="gender", type="string", length=20, nullable=false)
     */
    private $gender;
    /**
     * @var date
     *
     * @ORM\Column(name="datenaissance", type="date",nullable=false)
     */
    private $datenaissance;

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


}

