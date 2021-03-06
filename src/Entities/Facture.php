<?php
// namespace src\Entities;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity 
 * @ORM\Table(name="facture")
 */
class Facture {
    
    /**
     * @ORM\Id 
     * @ORM\Column(type="string", length="10")
     * @ORM\GeneratedValue(strategy="NONE")
    */
    private $numero;
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
     * @ORM\JoinColumn(name="numero_reglement", referencedColumnName="numero")
     */
    private $reglement;
    /**
     * @ORM\Column(type="boolean",options={"default": 1})
    */
    private $etat;
    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;
    /**
     * One Cart has One Customer.
     * @ORM\OneToOne(targetEntity="Consommation", inversedBy="facture")
     * @ORM\JoinColumn(name="consommation_id", referencedColumnName="id")
     */
    private $consommation;
    public function __construct () {
        // $this->consommation = new ArrayCollection ();
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
    public function getUser () {
        return $this->user;
    }
    public function setUser($user)
    {
        $this->user = $user;
    }
    public function getMontantFacture () {
        return $this->montantFacture;
    }
    public function setMontantFacture($montantFacture)
    {
        $this->montantFacture = $montantFacture;
    }
    public function getDateFacture () {
        return $this->dateFacture;
    }
    public function setDateFacture($dateFacture)
    {
        $this->dateFacture = $dateFacture;
    }
    public function getReglement () {
        return $this->reglement;
    }
    public function setReglement($reglement)
    {
        $this->reglement = $reglement;
    }
    public function getConsommation () {
        return $this->consommation;
    }
    public function setConsommation($consommation)
    {
        $this->consommation = $consommation;
    }
}