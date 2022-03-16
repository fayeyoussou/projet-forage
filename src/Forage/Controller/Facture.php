<?php

namespace src\Forage\Controller;

// use setasign\Fpdi\Tcpdf\Fpdi;
// use setasign\FpdiPdfParser\PdfParser;
// require_once('../vendor/autoload.php');
// use DateTime;

class Facture extends Numero
{
    public function __construct($em, $user)
    {
        parent::__construct($em, $user);
        $this->updateCompteur();
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
                    header('location: /facture/print?id=' . $facture->getNumero());
                }
            }
        } catch (\Exception $e) {
            echo $e;
        }
        // header('location: /facture/list');
    }
    public function printFacture($id)
    {
        if (isset($id)) {

            $facture = $this->em->find('Facture', $id);
            $pdf = new \src\Utility\Pdf('p', 'mm', 'A4', true, 'UTF-8', false);
            $pdf->docType = "A4";
            $pdf->showFacture($facture, $this->user);
        } else header('location: /compteur/list');
    }
    public function listFacture()
    {
        $facture = $this->em->getRepository('Facture')->findBy(array('reglement' => NULL, 'etat' => 1));
        return [
            'template' => 'listefacture.html.php',
            'title' => 'liste des reglements',
            'variables' => [
                'factures' => $facture
            ]
        ];
    }
   
    public function reglementSummary()
    {
        extract($_POST);
        if (count($factures) > 0) {
            for ($i = 0; $i  < count($factures); $i++) {
                $factures[$i] = $this->em->find('Facture', $factures[$i]);
            }
            return [
                'template' => 'sommaireReglement.html.php',
                'title' => 'sommaire reglement',
                'variables' => [
                    'factures' => $factures
                ]
            ];
        } else header('location: reglement/manage');
    }

    public function creerReglement()
    {
        // var_dump($_POST);
        try {
            extract($_POST);
            // var_dump($factures);
            $reglement = new \Reglement();
            $reglement->setUser($this->user);
            $reglement->setNumero($this->generateNumero('Facture'));
            foreach ($factures as $key => $value) {
                $facture = $this->em->find('Facture', $key);
                $facture->setReglement($reglement);
            }
            $this->em->persist($reglement);
            $this->em->flush();
            $pdf = new \src\Utility\Pdf('p', 'mm', 'A7', true, 'UTF-8', false);
            $pdf->docType = "A7";
            $pdf->showReglement($this->em->find('Reglement', $reglement->getNumero()), $this->user);
        } catch (\Exception $e) {
            echo "Err : <br>" . $e;
        }
    }

    public function printReglement(){
        if (isset($_GET['id'])) {
            $pdf = new \src\Utility\Pdf('p', 'mm', 'A7', true, 'UTF-8', false);
            $pdf->docType = "A7";
            $pdf->showReglement($this->em->find('Reglement', $_GET['id']));
        }
    }
}
