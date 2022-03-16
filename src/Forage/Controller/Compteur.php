<?php

namespace src\Forage\Controller;

class Compteur extends Numero
{

    public function __construct($em, $user)
    {
        parent::__construct($em, $user);
        $this->updateCompteur();
    }
    public function newcpt()
    {
        $cpteur = new \Compteur();
        // $cpteur->setCumul(0);
        $cpteur->setLastCumul(0);
        $cpteur->setUser($this->user);
        $cpteur->setEtat("Ouvert");
        $cpteur->setNumero($this->generateNumero('Compteur'));
        $this->em->persist($cpteur);
        $this->em->flush();
        return $cpteur->getNumero();
    }

    public function addnew () {
        return [
            'template' => 'newcpt.html.php',
            'title' => 'Compteur cree',
            'variables'=>[
                'compteur'=> $this->newcpt()
            ]
        ];
    }

    
    public function attribuer()
    {
        extract($_POST);
        try {
            foreach ($attributions as $abo => $compteur) {
                if ($compteur == 'nothing') {
                    continue;
                } else {
                    $cpteur = $this->em->find('Compteur',$compteur=='createnew'?$this->newcpt():$compteur);
                    $attribution = new \Attribution();
                    $abonnement = $this->em->find('Abonnement', $abo);
                    $cpteur->setAttribution($attribution);
                    $attribution->setCompteur($cpteur);
                    $attribution->setAbonnement($abonnement);
                    $attribution->setUser($this->user);
                    $abonnement->setAttribution($attribution);
                    $this->em->persist($attribution);
                    $this->em->flush();
                }
            }
            header('location: /abonnement/list');
        } catch (\Exception $e) {
            echo "error : <br>-----------------------------<br>" . $e;
        }
    }
    public function list () {
        $roles = $this->user->getRole()->getNom()=='Gestionnaire Commercial';
        $add = $roles ? 'and c.attribution is not null' : '';
        $this->updateCompteur();
        $compteurs = $this->em->createQuery("
        SELECT c
        FROM Compteur c
        WHERE c.etat != 'deleted' $add
        ")->getResult();
        // echo count($compteurs);
        return [
            'template'=> 'compteurlist.html.php',
            'title' => 'liste compteur',
            'variables'=>[
                'compteurs'=>$compteurs,
                'roles'=>$roles?'com':''
            ]
            ];
    }
    public function delete(){
        extract($_POST);
        foreach ($compteurs as $cpt) {
            $compteur = $this->em->find('Compteur',$cpt);
            $attr = $compteur->getAttribution();
            $compteur->setAttribution(NULL);
            $attr->getAbonnement()->setAttribution(NULL);
            $attr->setEtat(0);
            $compteur->setEtat('deleted');
        }
        $this->em->flush();
        header('location: /compteur/list');

    }
}
