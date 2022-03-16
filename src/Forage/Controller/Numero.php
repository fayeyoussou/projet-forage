<?php 

namespace src\Forage\Controller;

use DateTime;

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
    protected function updateCompteur() {
        $factures = $this->em->getRepository('Facture')->findAll();
        // echo "<br> Called";
        foreach ($factures as $facture) {
            if($facture->getReglement() == null ) { 
            // echo $facture->getNumero();
            $per = $facture->getConsommation()->getPeriode();
            $now = new \DateTime();
            $date = new \DateTime('20' . substr($per, 2, 2) . "-" . substr($per, 0, 2) . "-05");
            $date->add(new \DateInterval('P1M'));
            // echo "$per<br>";
            if($now > $date){
                $facture->getConsommation()->getCompteur()->setEtat('Coupe');
                $this->em->flush();
            } else {
                $facture->getConsommation()->getCompteur()->setEtat('Ouvert');
                $this->em->flush();
            }
        }  else {
            // echo $facture->getReglement()->getNumero();
        } 
        }

    }
 }