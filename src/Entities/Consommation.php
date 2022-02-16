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
     * @ORM\Column(type="string")
    */
    private $periode;
    /**
     * @ORM\Column(type="integer")
    */
    private $cumul;
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
     * @ORM\JoinColumn(name="numero_compteur", referencedColumnName="numero")
     */
    private $compteur;
    /**
     * One Customer has One Cart.
     * @ORM\OneToOne(targetEntity="Facture", mappedBy="consommation")
     */
    private $facture;
    /**
     * @ORM\Column(type="boolean",options={"default": 1})
    */
    
    private $etat;
    public function __construct () {
        $this->etat = 1;
        $this->periode = (new \DateTime())->format('my');
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
    public function getPeriode () {
        return $this->periode;
    }
    public function setPeriode($periode)
    {
        $this->periode = $periode;
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
    public function getCumul () {
        return $this->cumul;
    }
    public function setCumul($cumul)
    {
        $this->cumul = $cumul;
    }
}