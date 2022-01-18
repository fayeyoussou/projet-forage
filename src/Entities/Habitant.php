<?php
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity 
 * @ORM\Table(name="habitant")
 */
class Habitant {
    /**
     * @ORM\Id 
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
    */
    private $id;
    /**
     * @ORM\Column(type="string")
    */
    private $nom;
    /**
     * @ORM\Column(type="string")
    */
    private $adresse;
    /**
     * @ORM\Column(type="integer")
    */
    private $telephone;
    /**
     * One Village has chef.
     * @ORM\OneToOne(targetEntity="Village")
     * @ORM\JoinColumn(name="village", referencedColumnName="id")
     */
    private $village;
    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;
    /**
     * One habitant has many abonnement. This is the inverse side.
     * @ORM\OneToMany(targetEntity="Abonnement", mappedBy="habitant")
     */
    private $abonnements;
    /**
     * @ORM\Column(type="boolean",options={"default": 0})
    */
    private $etat;
    public function __construct () {
        $this->abonnements = new ArrayCollection ();
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
    public function getNom () {
        return $this->nom;
    }
    public function setNom($nom)
    {
        $this->nom = $nom;
    }
    public function getUser () {
        return $this->user;
    }
    public function setUser($user)
    {
        $this->user = $user;
    }
    public function getAdresse () {
        return $this->adresse;
    }
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }
    public function getTelephone () {
        return $this->telephone;
    }
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    }
    public function getVillage () {
        return $this->village;
    }
    public function setVillage($village)
    {
        $this->village = $village;
    }
    public function getAbonnements () {
        return $this->abonnements;
    }
    public function setAbonnements($abonnements)
    {
        $this->abonnements = $abonnements;
    }
}