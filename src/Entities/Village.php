<?php
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity 
 * @ORM\Table(name="village")
 */
class Village {
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
     * One Village has chef.
     * @ORM\OneToOne(targetEntity="Habitant")
     * @ORM\JoinColumn(name="chefVillage", referencedColumnName="id")
     */
    private $chefVillage;
    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;
    /**
     * @ORM\Column(type="boolean",options={"default": 0})
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
    public function getChefVillage () {
        return $this->chefVillage;
    }
    public function setChefVillage($chefVillage)
    {
        $this->chefVillage = $chefVillage;
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
    public function getEtat () {
        return $this->etat;
    }
    public function setEtat($etat)
    {
        $this->etat = $etat;
    }

}