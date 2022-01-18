<?php
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity 
 * @ORM\Table(name="habitant")
 */
class Habitant {
    /**
     * @ORM\Id 
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
    */
    private $id;
    /**
     * @ORM\Column(type="string")
    */
    private $nom;
    /**
     * @ORM\Column(type="string")
    */
    private $adresse;
    /**
     * @ORM\Column(type="integer")
    */
    private $telephone;
    /**
     * One Village has chef.
     * @OneToOne(targetEntity="Village")
     * @JoinColumn(name="village", referencedColumnName="id")
     */
    private $village;
    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;
    private $abonnements;
    /**
     * @ORM\Column(type="boolean")
    */
    private $etat;
    
}