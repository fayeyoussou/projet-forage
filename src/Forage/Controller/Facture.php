<?php

namespace src\Forage\Controller;

// use setasign\Fpdi\Tcpdf\Fpdi;
// use setasign\FpdiPdfParser\PdfParser;
require_once('../vendor/autoload.php');
// use DateTime;

class Facture extends Numero
{
    public function __construct($em, $user)
    {
        parent::__construct($em, $user);
    }

    public function generateFacture()
    {
        try {
            extract($_POST);
            if (isset($consommations)) {
                foreach ($consommations as $co) {
                    $cons = $this->em->find('Consommation', $co);
                    $facture = new \Facture();
                    $facture->setNumero($this->generateNumero('Facture'));
                    $facture->setConsommation($cons);
                    $facture->setDateFacture(new \DateTime());
                    $pu = $this->em->find('Numero', 'pri')->getNumero();
                    $facture->setMontantFacture($cons->getQuantite() * $pu);
                    $facture->setUser($this->user);
                    $this->em->persist($facture);
                    $this->em->flush();
                }
            }
        } catch (\Exception $e) {
            echo $e;
        }
        // header('location: /facture/list');
    }
    public function printFacture() {
        $facture = $this->em->find('Facture','FA22020002');
        $pdf = new Pdf('p','mm','A4',true,'UTF-8',false);
        $pdf->showFacture($facture,$this->user);

        

        
    }
}
