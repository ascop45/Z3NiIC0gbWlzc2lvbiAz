<?php

namespace emalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vehicule
 *
 * @ORM\Table(name="vehicule")
 * @ORM\Entity
 */
class Vehicule
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
     * @var string
     *
     * @ORM\Column(name="typeEssence", type="string", length=15, nullable=true)
     */
    private $typeessence;

    /**
     * @var string
     *
     * @ORM\Column(name="nombreCheveau", type="string", length=5, nullable=true)
     */
    private $nombrecheveau;

    /**
     * @var float
     *
     * @ORM\Column(name="prixAuKm", type="float", precision=10, scale=0, nullable=true)
     */
    private $prixaukm;


}

