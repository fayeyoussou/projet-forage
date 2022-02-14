<?php
// namespace src\Entities;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity 
 * @ORM\Table(name="abonnement")
 */
class Abonnement {
    /**
     * @ORM\Id 
     * @ORM\Column(type="string")
     * @ORM\GeneratedValue(strategy="NONE")
    */
    private $numero;
    /**
     * @ORM\Column(type="date")
    */
    private $dateAbo;
    /**
     * @ORM\Column(type="text")
    */
    private $description;
    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;
    /**
     * Many abonnement have one Habitant. This is the owning side.
     * @ORM\ManyToOne(targetEntity="Habitant", inversedBy="abonnements")
     * @ORM\JoinColumn(name="habitant_id", referencedColumnName="id")
     */
    private $habitant;
    /**
     * One Cart has One Customer.
     * @ORM\OneToOne(targetEntity="Attribution", inversedBy="abonnement")
     * @ORM\JoinColumn(name="attribution_id", referencedColumnName="id")
     */
    private $attribution;
    /**
     * @ORM\Column(type="boolean",options={"default": 1})
    */
    private $etat;
    public function __construct () {

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
    public function getDateAbo () {
        return $this->dateAbo;
    }
    public function setDateAbo($dateAbo)
    {
        $this->dateAbo = $dateAbo;
    }
    public function getDescription () {
        return $this->description;
    }
    public function setDescription($description)
    {
        $this->description = $description;
    }
    public function getHabitant () {
        return $this->habitant;
    }
    public function setHabitant($habitant)
    {
        $this->habitant = $habitant;
    }
    public function getAttribution () {
        return $this->attribution;
    }
    public function setAttribution($attribution)
    {
        $this->attribution = $attribution;
    }
}