<?php

namespace RansomGr\PubliciteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PubPos
 *
 * @ORM\Table(name="pub_pos")
 * @ORM\Entity(repositoryClass="RansomGr\PubliciteBundle\Repository\PubPosRepository")
 */
class PubPos
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
     * @var int
     *
     * @ORM\Column(name="pos", type="integer", unique=true)
     */
    private $position;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;
    /**
     * @var float
     *
     * @ORM\Column(name="Click_price", type="float")
     */
    private $Clickprice;

    /**
     * @return float
     */
    public function getClickprice()
    {
        return $this->Clickprice;
    }

    /**
     * @param float $Clickprice
     */
    public function setClickprice($Clickprice)
    {
        $this->Clickprice = $Clickprice;
    }


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
     * Set pos
     *
     * @param integer $pos
     *
     * @return PubPos
     */
    public function setPosition($pos)
    {
        $this->pos = $pos;

        return $this;
    }

    /**
     * Get position
     *
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }
    /**
     * Get position
     *
     * @return int
     */
    public function getPos()
    {
        return $this->position;
    }

    /**
     * Set price
     *
     * @param float $price
     *
     * @return PubPos
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

}

