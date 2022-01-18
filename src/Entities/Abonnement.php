<?php
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity 
 * @ORM\Table(name="abonnement")
 */
class Abonnement {
    /**
     * @ORM\Id 
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
    */
    private $id;
    /**
     * @ORM\Column(type="date")
    */
    private $dateAbo;
    /**
     * @ORM\Column(type="date")
    */
    private $description;
    private $client;
    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;
    private $compteur;
    /**
     * @ORM\Column(type="boolean")
    */
    private $etat;
}