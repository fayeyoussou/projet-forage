<?php
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity 
 * @ORM\Table(name="reglement")
 */
class Reglement {
    /**
     * @ORM\Id 
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
    */
    private $id;
    /**
     * @ORM\Column(type="date")
    */
    private $dateReglement;
    /**
     * @ORM\Column(type="integer")
    */
    private $montantReglement;
    /**
     * One product has many features. This is the inverse side.
     * @ORM\OneToMany(targetEntity="Facture", mappedBy="reglement")
     */
    private $factures;
    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;
    /**
     * @ORM\Column(type="boolean",options={"default": 0})
    */
    private $etat;

    
}