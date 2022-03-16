<?php

namespace src\Utility;

use setasign\Fpdi\Tcpdf\Fpdi;

class Pdf extends Fpdi
{
    public $docType = "A4";
    

    public function Header()
    {
        $this->AddFont('Amaranth', 'B', 'resources/font/Amaranth-Bold.php');
        $this->setTextColor(42, 230, 255);
        if($this->docType == "A7") {
        $this->setFont('Amaranth', 'B', '12');
        $this->setFontSpacing(1);
        $this->Image('resources/images/logo.png', 10, -16, 60);
        $this->Cell(60, 6, 'Sen Forage', 0, 0, 'C');

        
        
    }
    else {
        $this->setFont('Amaranth', 'B', '40');
        $this->setFontSpacing(5);
        $this->Image('resources/images/logo.png', 10, 3, 30);
        $this->Cell(210, 15, 'Sen Forage', 0, 0, 'C');
        }
        // $this->Cell('30');
    }
    // public function Footer()
    // {
    //     $this->setFont('Amaranth', 'B', '10');
    //     $this->setFontSpacing(5);
    //     $this->setTextColor(80,80,80);
    //     $this->Cell(40,10,"Telephone : 774906662",1,0);
    //     $this->Cell(40,10,"Adresse  : Km1 avenue cheikh Anta DIOP",1,0);
    // }
    public function showFacture($facture)
    {
        $user = $facture->getUser();
        $this->setCreator('me');
        $this->setAuthor($user->getPrenom() . ' ' . $user->getNom());
        $this->setTitle('Facture N*' . $facture->getNumero());
        $this->setSubject('Generation de facture sen-forage');
        $this->setKeywords('facture', 'sen-forage', $facture->getNumero());
        // $this->setSourceFile(HOME_DIRECTORY.'/../../../public/resources/Modele-facture.this');
        $this->AddPage();
        // $this->Cell('20');
        $this->Cell(190, 10, "", 0, 0);
        $this->Ln();
        $this->Cell(190, 10, "Facture " . $facture->getNumero(), 0, 0, 'C');
        $this->Ln(40);
        $cons = $facture->getConsommation();
        $compt = $cons->getCompteur();
        $abo = $compt->getAttribution()->getAbonnement();
        $client = $abo->getHabitant();
        $per = $cons->getPeriode();
        $an = substr((new \DateTime())->format('Y'), 0, 2);
        $date = new \DateTime($an . substr($per, 2, 2) . "-" . substr($per, 0, 2) . "-05");
        $date->add(new \DateInterval('P1M'));
        $this->Cell(190, 10, "A payer avant le " . $date->format('l d F Y'), 0, 0);
        $this->Ln();
        $this->Cell(190, 10, "Compteur Numero " . $compt->getNumero(), 0, 0);
        $this->Ln();
        $totalpaye = 0;
        
        $listCons = $compt->getConsommations();
        if (count($listCons) > 1) {
            $this->Cell(190, 10, "Liste des consommations :", 0, 0);
            $this->Ln(13);
            $this->Cell(45, 10, "periode", 1, 0, "C");
            $this->Cell(45, 10, "Quantite", 1, 0, "C");
            $this->Cell(45, 10, "Index", 1, 0, "C");
            $this->Cell(55, 10, "A payer", 1, 0, "C");
            $i = 0;

            foreach ($listCons as $cons) {
                if ($cons?->getFacture() != $facture) {
                    $this->Ln();
                    $res = $cons->getFacture()->getReglement();
                    $this->Cell(45, 10, $cons->getPeriode(), 1, 0, "C");
                    $this->Cell(45, 10, $cons->getQuantite(), 1, 0, "C");
                    $this->Cell(45, 10, $cons->getCumul(), 1, 0, "C");
                    $this->Cell(55, 10, $res == null ? $cons->getFacture()->getMontantFacture() : "Payé le " . $res->getDateReglement()->format('d-m-y'), 1, 0, "C");
                    $i++;
                    if ($res == null) {
                        $totalpaye += $cons->getFacture()->getMontantFacture();
                    }
                    if ($i == 5) break;
                }
            }
            $this->Ln(50 - 10 * $i);
        } else {
            $this->Ln(60);
        }
        $this->Cell(190, 10, "Information Facture Actuelle :", 0, 0,);
        $this->Ln(11);
        $this->Cell(45, 10, "periode", 1, 0, "C");
        $this->Cell(45, 10, "Quantite", 1, 0, "C");
        $this->Cell(45, 10, "Index", 1, 0, "C");
        $this->Cell(55, 10, "Montant", 1, 0, "C");
        $this->Ln();
        $d = new \DateTime($an . substr($per, 2, 2) . "-" . substr($per, 0, 2) . "-05");
        $this->Cell(45, 10, $d->format('F Y'), 1, 0, "C");
        $this->Cell(45, 10, $cons->getQuantite() . " mm3", 1, 0, "C");
        $this->Cell(45, 10, $cons->getCumul(), 1, 0, "C");
        $this->Cell(55, 10, $facture->getMontantFacture() . " Frs", 1, 0, "C");
        $this->Ln(30);
        $totalpaye += $facture->getMontantFacture();
        $this->Cell(190, 10, "Montant Total a Payer : " . $totalpaye . " Francs CFA", 0, 0, "R");
        $this->Ln();
        $str = new ChiffreEnLettres();
        $str = $str->Conversion($totalpaye + 1 - 1);
        $this->Cell(190, 10, "$str Francs CFA ", 0, 0, "R");
        $this->Ln();
        
        $this->Cell(190, 35, "", 0, 0);
        $this->Ln();
        // $this->setFont('Amaranth', 'B', '10');
        // $this->setFontSpacing(1);
        $this->setTextColor(80, 80, 80);
        $this->Cell(55, 10, "Tel : +221 33 822 19 81", 0, 0);
        $this->Cell(90, 10, "Adresse  : Km1 avenue cheikh Anta DIOP", 0, 0);
        $this->Cell(45, 10, "Fax : 33 822 19 81", 0, 0);
        $this->Ln();
        $this->Cell(190, 10, '© Copyright 2022 / Youssoupha FAYE  Tous Droits reservés');
        $this->output();
    }
    public function showReglement (\Reglement $reglement) {
        $user = $reglement->getUser();
        $this->setCreator('me');
        $this->setAuthor($user->getPrenom() . ' ' . $user->getNom());
        $this->setTitle('Facture N*'.  $reglement->getNumero());
        $this->setSubject('Generation de Reglement sen-forage');
        $this->setKeywords('facture', 'sen-forage', $reglement->getNumero());
        // $this->setSourceFile(HOME_DIRECTORY.'/../../../public/resources/Modele-facture.this');
        $this->AddPage();
        $this->AddFont('notese', 'R', 'resources/font/NotoSe.php');
        $this->setTextColor(80, 80, 80);
        $this->setFont('notese', 'R', '8');
        $this->setFontSpacing(0);

        // $this->Cell('20');
        $this->Cell(55, 13, "", 0, 0);
        $this->Ln();
        $this->Cell(55, 5, "Reglement N* ".$reglement->getNumero() , 0, 0, 'C');
        $this->Ln(20);
        $sommes = 0;
        $coupure = 0;
        $dateR = $reglement->getDateReglement();
        $factures = $reglement->getFactures();
        foreach ($factures as $facture) {
            $per = $facture->getConsommation()->getPeriode();
            $date = new \DateTime('20' . substr($per, 2, 2) . "-" . substr($per, 0, 2) . "-05");
            $date->add(new \DateInterval('P1M'));
            $this->Cell(55, 5, $facture->getNumero()." : ".$facture->getMontantFacture()." Frs", 0, 0);
            if($dateR > $date)
            {
                $sommes += ($facture->getMontantFacture()+$facture->getMontantFacture()*0.05);
                $coupure = $facture->getMontantFacture()*0.05;
            }
            else $sommes += $facture->getMontantFacture();
            $this->Ln();
        }
        $this->Cell(55, 5,"Total : ".$sommes ." Frs", 0, 0,"R");
        $this->Ln();
        if($coupure > 0){
        $this->Cell(55, 5,"Bon de coupure : ".$sommes ." Frs", 0, 0,"R");
        }
        $str = new ChiffreEnLettres();
        $this->setFont('notese', 'R', '6');
        $this->setFontSpacing(-0.1);
        try{

            $str = $str->Conversion($sommes + 1 - 1);
            $this->Ln();
            $this->Cell(55, 5,$str." Frs", 0, 0,"R");
        } catch(\Exception $e) {

        } finally {

            $this->output();
        }

    }
}
