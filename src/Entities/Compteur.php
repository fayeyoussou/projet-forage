<?php
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity 
 * @ORM\Table(name="compteur")
 */
class Compteur {
    /**
     * @ORM\Id 
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
    */
    private $id;
    /**
     * @ORM\Column(type="integer")
    */
    private $cumul;
    /**
     * @ORM\Column(type="integer")
    */
    private $lastcumul;
    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;
    /**
     * One Cart has One Customer.
     * @ORM\OneToOne(targetEntity="Abonnement", inversedBy="compteur")
     * @ORM\JoinColumn(name="abonnement_id", referencedColumnName="id")
     */
    private $abonnement;
    /**
     * @ORM\Column(type="string" ,length="10")
    */
    private $etat;
    /**
     * One product has many features. This is the inverse side.
     * @ORM\OneToMany(targetEntity="Consommation", mappedBy="compteur")
     */
    private $consommations;
    
}