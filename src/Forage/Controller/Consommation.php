<?php
namespace src\Forage\Controller;

use DateTime;

class Consommation extends Numero {
    public function __construct($em,$user)
    {
        parent::__construct($em,$user);
    }
    public function toList(){
        // try{
        // $compteur = $this->em->find('Compteur',$_GET['id']);
        //     $cons = $this->em->getRepository('Consommation')->findOneBy(array('compteur'=>$compteur));
        //     echo $cons->getFacture();

        // } catch (\Exception $e) {
        //     echo $e;
        // }
        $compteur = $this->em->find('Compteur',$_GET['id']);
        $periode = (new \DateTime())->format('my');
        // echo "Periode en cours :".$periode;
        $cons = $this->em->getRepository('Consommation')->findBy(array('periode'=>$periode,'compteur'=>$compteur));
        $toAdd = count($cons) == 0 && (new \DateTime())->format('d') > 14;
        
        
        return [
            'template'=> 'consommationsliste.html.php',
            'title' => 'Consommations du compteur'.$compteur->getNumero(),
            'variables'=> [
                'toAdd'=>$toAdd,
                'compteur'=> $compteur
            ]
        ];
        
    }
    public function addCForm () {
        $cpt = $this->em->find('Compteur',$_GET['id']);
        return [
            'template'=> 'addConso.html.php',
            'title'=>'ajout de consommation pour '.$cpt->getNumero(),
            'variables'=>[
                'compteur'=>$cpt
            ]
        ];
    }

    public function valideC() {
        extract($_POST);
        $compteur = $this->em->find('Compteur',$consommations['compteur']);
        if($consommations['newi'] > $compteur->getLastCumul()){
        $consommation = new \Consommation();
        $consommation->setQuantite($consommations['newi'] - $compteur->getLastCumul());
        $consommation->setUSer($user);
        $consommation->setCompteur($compteur);
        $compteur->setLastCumul($consommations['newi']);
        $consommation->setCumul($consommations['newi']);
        $this->em->persist($consommation);
        $this->em->flush();
        header('location: /compteur/consommation?id='.$compteur->getNumero());
        } else header('location: /consommation/add?id='.$compteur->getNumero());

    }
}