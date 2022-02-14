<?php 
class Compteur {
    private $em;
    private $user;
    public function __construct($em,$user)
    {
        $this->em = $em;
        $this->user = $user;
    }
}