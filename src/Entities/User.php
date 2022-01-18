<?php
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity 
 * @ORM\Table(name="user")
 */
class User {
    /**
     * @ORM\Id 
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
    */
    private $id;
    private $nom;
    private $prenom;
    private $email;
    private $password;
    /**
     * @ORM\Column(type="boolean")
    */
    private $etat;
    private $role;
    
}