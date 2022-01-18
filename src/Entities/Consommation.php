<?php
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity 
 * @ORM\Table(name="consommation")
 */
class Consommation {
    /**
     * @ORM\Id 
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
    */
    private $id;
    /**
     * @ORM\Column(type="date")
    */
    private $dateConsommation;
    /**
     * @ORM\Column(type="integer")
    */
    private $quantite;
    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;
    /**
     * Many features have one product. This is the owning side.
     * @ORM\ManyToOne(targetEntity="Compteur", inversedBy="consommations")
     * @ORM\JoinColumn(name="compteur_id", referencedColumnName="id")
     */
    private $compteur;
    /**
     * One product has many features. This is the inverse side.
     * @ORM\OneToMany(targetEntity="Facture", mappedBy="consommation")
     */
    private $facture;
    /**
     * @ORM\Column(type="boolean",options={"default": 0})
    */
    
    private $etat;
    
}