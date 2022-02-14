<?php

namespace src\Forage\Controller;

class Abonnement {
    private $em;
    private $user;
    public function __construct($em,$user)
    {
        $this->em = $em;
        $this->user = $user;
    }
    public function createabonnement () {
        $clients =  $this->em->createQuery('
        SELECT v
        FROM Habitant v
        WHERE v.etat = 1
        ')->getResult();
        return [
            'template'=> 'abonnementcreate.html.php',
            'title'=> 'create des abonnes',
            'variables'=> [
                'clients'=>$clients
            ]
        ];
    }
    public function abonnementSubmit(){
        extract($_POST);
        // var_dump($abonnement);
        if(isset($abonnement['etat'])) $abo = $this->em->find('Abonnement',$abonnment['etat']);
        else {
            $abo = new \Abonnement();
            $abo->setUser($this->user);
        }
        $datetime = new \DateTime($abonnement['date']);
        $abo->setDateAbo($datetime);
        $abo->setHabitant($this->em->find('Habitant',$abonnement['client']));
        $abo->setEtat(1);
        $abo->setDescription($abonnement['description']);
        // var_dump($abo);
        try {
        $this->em->persist($abo);
        $this->em->flush();
    }
        catch (\Exception $e){
            var_dump ($e);
        }
        header('location: /abonnement/list');
    }
    public function list () {
        extract($_GET);
        if (isset($_GET['id'])){
            $abonnements = $this->em->getRepository('Abonnement')->findBy(array('etat'=>1,'habitant'=>$this->em->find('Habitant',$id)));
        } else {
            $abonnements = $this->em->getRepository('Abonnement')->findBy(array('etat'=>1,));

        }
    
        return [
            'template'=> 'abolist.html.php',
            'title'=> 'liste des abonnements',
            'variables'=> [
                'abonnements'=>$abonnements
            ]
        ];
    }
    public function delete() {
        extract($_POST);
        foreach ($abonnements as $abo) {
            $this->em->find('Abonnement', $abo)->setEtat(0);
        }
        $this->em->flush();
        header('location: /abonnement/list');
    }
}