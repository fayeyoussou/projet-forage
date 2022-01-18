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
    public function __construct () {

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
    public function getPrenom () {
        return $this->prenom;
    }
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }
    public function getEmail () {
        return $this->email;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function getPassword () {
        return $this->password;
    }
    public function setPassword($password)
    {
        $this->password = $password;
    }
    public function getRole () {
        return $this->role;
    }
    public function setRole($role)
    {
        $this->role = $role;
    }
}