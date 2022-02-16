<?php
// namespace src\Entities;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity 
 * @ORM\Table(name="attribution")
 */
class Attribution {
     /**
     * @ORM\Id 
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
    */
    private $id;
    /**
     * One Village has chef.
     * @ORM\ManyToOne(targetEntity="Compteur")
     * @ORM\JoinColumn(name="numero_compteur", referencedColumnName="numero")
     */
    private Compteur $compteur;
    /**
     * One Village has chef.
     * @ORM\ManyToOne(targetEntity="Abonnement")
     * @ORM\JoinColumn(name="numero_abonnement", referencedColumnName="numero")
     */
    private Abonnement $abonnement;
    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;
    /**
     * @ORM\Column(type="date")
    */
    private $dateAttribution;
    /**
     * @ORM\Column(type="boolean",options={"default": 1})
    */
    private $etat;
    public function __construct()
    {
        $this->etat = 1;
        $this->dateAttribution = new \DateTime();
    }
    public function getId () {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function getCompteur () {
        return $this->compteur;
    }
    public function setCompteur($compteur)
    {
        $this->compteur = $compteur;
    }
    public function getAbonnement () {
        return $this->abonnement;
    }
    
    public function setAbonnement($abonnement)
    {
        $this->abonnement = $abonnement;
    }
    public function getDateAttribution () {
        return $this->dateAttribution;
    }
    public function setDateAttribution($dateAttribution)
    {
        $this->dateAttribution = $dateAttribution;
    }
    public function getUser () {
        return $this->user;
    }
    public function setUser($user)
    {
        $this->user = $user;
    }
    public function getEtat () {
        return $this->etat;
    }
    public function sEtetat($etat)
    {
        $this->etat = $etat;
    }
}