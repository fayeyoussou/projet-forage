<?php
// namespace src\Entities;
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
     * @ORM\Column(type="boolean",options={"default": 1})
    */
    
    private $etat;
    public function __construct () {

    }
    public function getId () {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
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
    public function getDateConsommation () {
        return $this->dateConsommation;
    }
    public function setDateConsommation($dateConsommation)
    {
        $this->dateConsommation = $dateConsommation;
    }
    public function getQuantite () {
        return $this->quantite;
    }
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;
    }
    public function getCompteur () {
        return $this->compteur;
    }
    public function setCompteur($compteur)
    {
        $this->compteur = $compteur;
    }
    public function getFacture () {
        return $this->facture;
    }
    public function setFacture($facture)
    {
        $this->facture = $facture;
    }
}