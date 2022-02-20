<?php
// namespace src\Entities;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity 
 * @ORM\Table(name="reglement")
 */
class Reglement {
    /**
     * @ORM\Id 
     * @ORM\Column(type="string")
     * @ORM\GeneratedValue(strategy="NONE")
    */
    private $numero;
    /**
     * @ORM\Column(type="date")
    */
    private $dateReglement;
    /**
     * One product has many features. This is the inverse side.
     * @ORM\OneToMany(targetEntity="Facture", mappedBy="reglement")
     */
    private $factures;
    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="id_user", referencedColumnName="id")
     */
    private $user;
    /**
     * @ORM\Column(type="boolean",options={"default": 1})
    */
    private $etat;
    public function __construct () {
        $this->factures = new ArrayCollection ();
        $this->dateReglement = new \DateTime();
        $this->etat = 1;
    }
    public function getNumero () {
        return $this->numero;
    }
    public function setNumero($numero)
    {
        $this->numero = $numero;
    }
    public function getEtat () {
        return $this->etat;
    }
    public function setEtat($etat)
    {
        $this->etat = $etat;
    }
    public function getDateReglement () {
        return $this->dateReglement;
    }
    public function setDateReglement($dateReglement)
    {
        $this->dateReglement = $dateReglement;
    }
    public function getMontantReglement () {
        return $this->montantReglement;
    }
    public function setMontantReglement($montantReglement)
    {
        $this->montantReglement = $montantReglement;
    }
    public function getUser () {
        return $this->user;
    }
    public function setUser($user)
    {
        $this->user = $user;
    }
    public function getFactures () {
        return $this->factures;
    }
    public function setFactures($factures)
    {
        $this->factures = $factures;
    }
}