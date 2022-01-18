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
     * @OneToOne(targetEntity="Habitant")
     * @JoinColumn(name="chefVillage", referencedColumnName="id")
     */
    private $chefVillage;
    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;
    /**
     * @ORM\Column(type="boolean")
    */
    private $etat;

}