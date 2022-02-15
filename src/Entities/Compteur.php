<?php
// namespace src\Entities;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity 
 * @ORM\Table(name="compteur")
 */
class Compteur {
    /**
     * @ORM\Id 
     * @ORM\Column(type="string", length="10")
     * @ORM\GeneratedValue(strategy="NONE")
    */
    private $numero;
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
     * @ORM\OneToOne(targetEntity="Attribution", inversedBy="compteur")
     * @ORM\JoinColumn(name="attribution_id", referencedColumnName="id")
     */
    private $attribution;
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
    public function getAttribution () {
        return $this->attribution;
    }
    public function setAttribution($attribution)
    {
        $this->attribution = $attribution;
    }
    public function getConsommations () {
        return $this->consommations;
    }
    public function setConsommations($consommations)
    {
        $this->consommations = $consommations;
    }
    public function getInfo () {
        if($this->attribution === null){
            return "compteur non attribues";
        }
        else return "Proprio : ".
        $this->attribution->getAbonnement()->getHabitant()->getNom().
        "<br>Abonnement :".$this->attribution->getAbonnement()->getNumero()."<br>cree :".
        $this->attribution->getUser()->getPrenom()." ".
        $this->attribution->getUser()->getNom().
        "<br>date ".$this->attribution->getDateAttribution()->format('d-m-y');
    }
}