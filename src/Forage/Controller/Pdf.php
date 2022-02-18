<?php

namespace src\Forage\Controller;
use setasign\Fpdi\Tcpdf\Fpdi;

class Pdf extends Fpdi {
    public $obj;
    public $type;
    
    public function Header()
    {
        $this->AddFont('Amaranth','B','resources/Amaranth-Bold.php');
        $this->setFont('Amaranth','B','40');
        $this->setFontSpacing(5);
        // $this->Cell('30');
        $this->Image('resources/images/logo.png',10,3,30);
        $this->Cell(210,15,'Sen Forage',1,0,'C');
    }
    public function showFacture($facture,$user){
        $this->setCreator('me');
        $this->setAuthor($user->getPrenom().' '.$user->getNom() );
        $this->setTitle('Facture N*'.$facture->getNumero());
        $this->setSubject('Generation de facture sen-forage');
        $this->setKeywords('facture','sen-forage',$facture->getNumero());
        // $this->setSourceFile(HOME_DIRECTORY.'/../../../public/resources/Modele-facture.this');
        $this->AddPage();
        // $this->Cell('20');
        $this->Cell(190,10,"",1,0);
        $this->Ln();
        $this->Cell(190,10,"Facture N* Fa19927",1,0,'C');
        $this->Ln(40);
        $cons = $facture->getConsommation();
        $compt = $cons->getCompteur();
        $abo = $compt->getAttribution()->getAbonnement();
        $client = $abo->getHabitant();
        $per = $cons->getPeriode();
        substr($per,2,2);
        $an = substr((new \DateTime())->format('Y'),0,2);
        $date = new \DateTime($an.substr($per,2,2)."-".substr($per,0,2)."-05");

        $this->Cell(190,10,$date->format('Ymd')."Compteur Numero ".$compt->getNumero(),1,0);
        $this->Ln();
        $this->Cell(190,10,"Liste des consommations :",1,0,"C");
        $this->Ln(20);
        


        $this->output();

    }
}