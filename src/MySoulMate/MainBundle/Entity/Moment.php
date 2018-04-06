<?php

namespace MySoulMate\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Moment
 *
 * @ORM\Table(name="moment", indexes={@ORM\Index(name="IDX_358C88A262894749", columns={"relation"}), @ORM\Index(name="fk_moment_couple", columns={"c_moment"})})
 * @ORM\Entity
 */
class Moment
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
     * @var \Conseil
     *
     * @ORM\ManyToOne(targetEntity="Conseil")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="c_moment", referencedColumnName="ID")
     * })
     */
    private $cMoment;

    /**
     * @var \Relation
     *
     * @ORM\ManyToOne(targetEntity="Relation")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="relation", referencedColumnName="ID")
     * })
     */
    private $relation;


}

