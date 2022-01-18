<?php
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity 
 * @ORM\Table(name="facture")
 */
class Facture {
    
    /**
     * @ORM\Id 
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
    */
    private $id;
    /**
     * @ORM\Column(type="integer")
    */
    private $montantFacture;
    /**
     * @ORM\Column(type="date")
    */
    private $dateFacture;
    /**
     * Many features have one product. This is the owning side.
     * @ORM\ManyToOne(targetEntity="Reglement", inversedBy="factures")
     * @ORM\JoinColumn(name="reglement_id", referencedColumnName="id")
     */
    private $reglement;
    /**
     * @ORM\Column(type="boolean",options={"default": 0})
    */
    private $etat;
    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;
    /**
     * Many features have one product. This is the owning side.
     * @ORM\ManyToOne(targetEntity="Consommation", inversedBy="facture")
     * @ORM\JoinColumn(name="consommation_id", referencedColumnName="id")
     */
    private $consommations;
    // private $reglement;
    
}