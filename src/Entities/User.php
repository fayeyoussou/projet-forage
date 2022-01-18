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
    /**
    * @ORM\Column(type="string", length="50")
    */
    private $nom;
    /**
     * @ORM\Column(type="string", length="50")
    */
    private $prenom;
    /**
     * @ORM\Column(type="string", length="80")
    */
    private $email;
    /**
     * @ORM\Column(type="string")
    */
    private $password;
    /**
     * @ORM\Column(type="boolean",options={"default": 0})
    */
    private $etat;
    /**
     * @ORM\ManyToOne(targetEntity="Role")
     * @ORM\JoinColumn(name="role", referencedColumnName="id")
     */
    private $role;
    
}