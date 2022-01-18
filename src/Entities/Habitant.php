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
     * @ORM\OneToOne(targetEntity="Village")
     * @ORM\JoinColumn(name="village", referencedColumnName="id")
     */
    private $village;
    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;
    /**
     * One habitant has many abonnement. This is the inverse side.
     * @ORM\OneToMany(targetEntity="Abonnement", mappedBy="habitant")
     */
    private $abonnements;
    /**
     * @ORM\Column(type="boolean",options={"default": 0})
    */
    private $etat;
    
}