<?php

namespace MySoulMate\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Caracteristique
 *
 * @ORM\Table(name="caracteristique")
 * @ORM\Entity
 */
class Caracteristique
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
     * @ORM\Column(name="corpulence", type="string", length=50, nullable=true)
     */
    private $corpulence;

    /**
     * @var string
     *
     * @ORM\Column(name="pilosite", type="string", length=50, nullable=true)
     */
    private $pilosite;

    /**
     * @var string
     *
     * @ORM\Column(name="origine", type="string", length=50, nullable=true)
     */
    private $origine;

    /**
     * @var string
     *
     * @ORM\Column(name="profession", type="string", length=50, nullable=true)
     */
    private $profession;

    /**
     * @var string
     *
     * @ORM\Column(name="alcool", type="string", length=50, nullable=true)
     */
    private $alcool;

    /**
     * @var string
     *
     * @ORM\Column(name="tabac", type="string", length=50, nullable=true)
     */
    private $tabac;

    /**
     * @var string
     *
     * @ORM\Column(name="taille", type="string", length=50, nullable=true)
     */
    private $taille;

    /**
     * @var string
     *
     * @ORM\Column(name="cheveux", type="string", length=50, nullable=true)
     */
    private $cheveux;

    /**
     * @var string
     *
     * @ORM\Column(name="yeux", type="string", length=50, nullable=true)
     */
    private $yeux;

    /**
     * @var string
     *
     * @ORM\Column(name="caractere", type="string", length=50, nullable=true)
     */
    private $caractere;

    /**
     * @var string
     *
     * @ORM\Column(name="statut", type="string", length=50, nullable=true)
     */
    private $statut;

    /**
     * @var string
     *
     * @ORM\Column(name="cuisine", type="string", length=50, nullable=true)
     */
    private $cuisine;


}

