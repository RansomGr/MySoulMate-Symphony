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
    public function getCorpulence()
    {
        return $this->corpulence;
    }

    /**
     * @param string $corpulence
     */
    public function setCorpulence($corpulence)
    {
        $this->corpulence = $corpulence;
    }

    /**
     * @return string
     */
    public function getPilosite()
    {
        return $this->pilosite;
    }

    /**
     * @param string $pilosite
     */
    public function setPilosite($pilosite)
    {
        $this->pilosite = $pilosite;
    }

    /**
     * @return string
     */
    public function getOrigine()
    {
        return $this->origine;
    }

    /**
     * @param string $origine
     */
    public function setOrigine($origine)
    {
        $this->origine = $origine;
    }

    /**
     * @return string
     */
    public function getProfession()
    {
        return $this->profession;
    }

    /**
     * @param string $profession
     */
    public function setProfession($profession)
    {
        $this->profession = $profession;
    }

    /**
     * @return string
     */
    public function getAlcool()
    {
        return $this->alcool;
    }

    /**
     * @param string $alcool
     */
    public function setAlcool($alcool)
    {
        $this->alcool = $alcool;
    }

    /**
     * @return string
     */
    public function getTabac()
    {
        return $this->tabac;
    }

    /**
     * @param string $tabac
     */
    public function setTabac($tabac)
    {
        $this->tabac = $tabac;
    }

    /**
     * @return string
     */
    public function getTaille()
    {
        return $this->taille;
    }

    /**
     * @param string $taille
     */
    public function setTaille($taille)
    {
        $this->taille = $taille;
    }

    /**
     * @return string
     */
    public function getCheveux()
    {
        return $this->cheveux;
    }

    /**
     * @param string $cheveux
     */
    public function setCheveux($cheveux)
    {
        $this->cheveux = $cheveux;
    }

    /**
     * @return string
     */
    public function getYeux()
    {
        return $this->yeux;
    }

    /**
     * @param string $yeux
     */
    public function setYeux($yeux)
    {
        $this->yeux = $yeux;
    }

    /**
     * @return string
     */
    public function getCaractere()
    {
        return $this->caractere;
    }

    /**
     * @param string $caractere
     */
    public function setCaractere($caractere)
    {
        $this->caractere = $caractere;
    }

    /**
     * @return string
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * @param string $statut
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;
    }

    /**
     * @return string
     */
    public function getCuisine()
    {
        return $this->cuisine;
    }

    /**
     * @param string $cuisine
     */
    public function setCuisine($cuisine)
    {
        $this->cuisine = $cuisine;
    }


}

