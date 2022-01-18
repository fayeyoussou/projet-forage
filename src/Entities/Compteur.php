<?php
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity 
 * @ORM\Table(name="compteur")
 */
class Compteur {
    /**
     * @ORM\Id 
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
    */
    private $id;
    /**
     * @ORM\Column(type="integer")
    */
    private $cumul;
    /**
     * @ORM\Column(type="integer")
    */
    private $lastCumul;
    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;
    /**
     * One Cart has One Customer.
     * @ORM\OneToOne(targetEntity="Abonnement", inversedBy="compteur")
     * @ORM\JoinColumn(name="abonnement_id", referencedColumnName="id")
     */
    private $abonnement;
    /**
     * @ORM\Column(type="string" ,length="10")
    */
    private $etat;
    /**
     * One product has many features. This is the inverse side.
     * @ORM\OneToMany(targetEntity="Consommation", mappedBy="compteur")
     */
    private $consommations;
    public function __construct () {
        $this->consommations = new ArrayCollection();

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
    public function getCumul () {
        return $this->cumul;
    }
    public function setCumul($cumul)
    {
        $this->cumul = $cumul;
    }
    public function getLastCumul () {
        return $this->lastCumul;
    }
    public function setLastCumul($lastCumul)
    {
        $this->lastCumul = $lastCumul;
    }
    public function getAbonnement () {
        return $this->abonnement;
    }
    public function setAbonnement($abonnement)
    {
        $this->abonnement = $abonnement;
    }
    public function getConsommations () {
        return $this->consommations;
    }
    public function setConsommations($consommations)
    {
        $this->consommations = $consommations;
    }
}