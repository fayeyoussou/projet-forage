<?php
namespace src\Forage\Controller;

use DateTime;

class Consommation extends Numero {
    public function __construct($em,$user)
    {
        parent::__construct($em,$user);
        $this->updateCompteur();
    }
    public function toList($id){
        // try{
        // $compteur = $this->em->find('Compteur',$_GET['id']);
        //     $cons = $this->em->getRepository('Consommation')->findOneBy(array('compteur'=>$compteur));
        //     echo $cons->getFacture();

        // } catch (\Exception $e) {
        //     echo $e;
        // }
        $compteur = $this->em->find('Compteur',$id);
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
    public function addCForm ($id) {
        $cpt = $this->em->find('Compteur',$id);
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
        header('location: /compteur/consommation/'.$compteur->getNumero());
        } else header('location: /consommation/add/'.$compteur->getNumero());

    }
    public function showTaux (){
        $taux = $this->em->find('Numero','pri')->getNumero();
        return [
            'template' => 'taux.html.php',
            'title' => 'changer prix litre d\'eau',
            'variables'=>[
                'taux'=>$taux
            ]
        ];
    }
    public function submitTaux(){
        extract($_POST);
        echo $taux;
        $prix = $this->em->find('Numero','pri');
        $prix->setNumero($taux);
        $this->em->flush();
        header('location: /home/dashboard');
    }
}