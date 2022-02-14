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
     * One Product has One Shipment.
     * @ORM\OneToOne(targetEntity="Compteur")
     * @ORM\JoinColumn(name="numero_compteur", referencedColumnName="numero")
     */
    private $compteur;
    /**
     * One Product has One Shipment.
     * @ORM\OneToOne(targetEntity="Abonnement")
     * @ORM\JoinColumn(name="numero_abonnement", referencedColumnName="numero")
     */
    private $abonnement;
    /**
     * @ORM\Column(type="date")
    */
    private $dateAttribution;
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
}