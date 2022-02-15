<?php 

namespace src\Forage\Controller;
 class Numero {
     protected $em;
     protected $user;
     public function __construct($em,$user)
     {
         $this->em = $em;
         $this->user = $user;
     }
     protected function generateNumero(string $obj){
        $periode = (new \DateTime())->format('ym');
        $num = $this->em->find('Numero', strtolower(substr($obj,0,3)));
        // return $num->getNumero();
        $periode = (new \DateTime())->format('ym');
        if (!$num->getPeriode() == $periode) {
            $num->setNumero(0);
            $num->setPeriode($periode);
        }
        $generated = strtoupper(substr($obj,0,2)) . $periode . sprintf("%04d", $num->getNumero());
        $this->em->flush();
        return $generated;

    }
 }