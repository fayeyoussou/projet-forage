<?php
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity 
 * @ORM\Table(name="role")
 */
class Role {
    /**
     * @ORM\Id 
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
    */
    private $id;
    /**
     * @ORM\Column(type="string",length=10)
    */
    private $nom;
    public function __construct () {

    }
    public function getId () {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function getNom () {
        return $this->nom;
    }
    public function setNom($nom)
    {
        $this->nom = $nom;
    }    
}