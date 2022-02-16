<?php
namespace src\Forage\Controller;

// use DateTime;

class Facture extends Numero {
    public function __construct($em,$user)
    {
        parent::__construct($em,$user);
    }

    public function generateFacture() 
    {
        extract($_POST);
        if(isset($consommations)){
            foreach ($consommation as $co) {
                $cons = $this->em->find('Consommation',$co);
                $facture = new \Facture();
                $facture->setNumero($this->generateNumero('Facture'));
                $facture->setConsommation($cons);
                $facture->setDateFacture(new \DateTime());
                $pu = $this->em->find('Numero','pri')->getNumero();
                $facture->setMontantFacture($cons->getQuantite()*$pu);
                $facture->setUser($this->user);
                $this->em->persist($facture);
                $this->em->flush();
            }
            
        }
    }
}