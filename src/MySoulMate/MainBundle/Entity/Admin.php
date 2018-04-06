<?php

namespace MySoulMate\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
/**
 * Admin
 *
 * @ORM\Table(name="admin", uniqueConstraints={@ORM\UniqueConstraint(name="login", columns={"login"}), @ORM\UniqueConstraint(name="UNIQ_880E0D7692FC23A8", columns={"username_canonical"}), @ORM\UniqueConstraint(name="UNIQ_880E0D76A0D96FBF", columns={"email_canonical"}), @ORM\UniqueConstraint(name="UNIQ_880E0D76C05FB297", columns={"confirmation_token"})})
 * @ORM\Entity
 */
class Admin extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=200, nullable=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=200, nullable=true)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="login", type="string", length=50, nullable=false)
     */
    private $login;

    /**
     * @var string
     *
     * @ORM\Column(name="motdepasse", type="string", length=200, nullable=true)
     */
    private $motdepasse;



}

