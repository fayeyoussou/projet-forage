<?php
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity 
 * @ORM\Table(name="numero")
 */
class Numero {
    /**
     * @ORM\Id 
     * @ORM\Column(type="string", length="3")
     * @ORM\GeneratedValue(strategy="NONE")
    */
    private $nom;
    /**
     * @ORM\Column(type="string", length="4")
    */
    private $periode;
    /**
     * @ORM\Column(type="integer")
    */
    private $numero;
    public function __construct()
    {
        
    }
    public function getNom () {
        return $this->nom;
    }
    public function setNom($nom)
    {
        $this->nom = $nom;
    }
    public function getNumero () {
        return $this->numero;
    }
    public function setNumero($numero)
    {
        $this->numero = $numero;
    }
    public function getPeriode () {
        return $this->periode;
    }
    public function setPeriode($periode)
    {
        $this->periode = $periode;
    }

}