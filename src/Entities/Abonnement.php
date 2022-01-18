<?php
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity 
 * @ORM\Table(name="abonnement")
 */
class Abonnement {
    /**
     * @ORM\Id 
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
    */
    private $id;
    /**
     * @ORM\Column(type="date")
    */
    private $dateAbo;
    /**
     * @ORM\Column(type="text")
    */
    private $description;
    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;
    /**
     * Many abonnement have one Habitant. This is the owning side.
     * @ORM\ManyToOne(targetEntity="Habitant", inversedBy="abonnements")
     * @ORM\JoinColumn(name="habitant_id", referencedColumnName="id")
     */
    private $habitant;
    /**
     * One Customer has One Cart.
     * @ORM\OneToOne(targetEntity="Compteur", mappedBy="abonnement")
     */
    private $compteur;
    /**
     * @ORM\Column(type="boolean",options={"default": 0})
    */
    private $etat;
}