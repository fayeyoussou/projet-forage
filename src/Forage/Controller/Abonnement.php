<?php

namespace src\Forage\Controller;

class Abonnement extends Numero
{
    public function __construct($em, $user)
    {
        parent::__construct($em,$user);
    }
    public function createabonnement($id)
    {
        $clients =  $this->em->createQuery('
        SELECT v
        FROM Habitant v
        WHERE v.etat = 1
        ')->getResult();
        if (isset($id)) {
            $abonnement = $this->em->find('Abonnement', $id);
            return [
                'template' => 'abonnementcreate.html.php',
                'title' => 'mise a jour d\'abonnement',
                'variables' => [
                    'clients' => $clients,
                    'abonnement' => $abonnement
                ]
            ];
        }

        return [
            'template' => 'abonnementcreate.html.php',
            'title' => 'create des abonnes',
            'variables' => [
                'clients' => $clients
            ]
        ];
    }
    
    public function abonnementSubmit()
    {
        extract($_POST);
        // var_dump($abonnement);
        if (isset($abonnement['etat'])) $abo = $this->em->find('Abonnement', $abonnement['etat']);
        else {
            $abo = new \Abonnement();
            $abo->setUser($this->user);
            $abo->setNumero($this->generateNumero('Abonnement'));
        }
        $datetime = new \DateTime($abonnement['date']);
        $abo->setDateAbo($datetime);
        $abo->setHabitant($this->em->find('Habitant', $abonnement['client']));
        $abo->setEtat(1);
        $abo->setDescription($abonnement['description']);
        // var_dump($abo);
        try {
            $this->em->persist($abo);
            $this->em->flush();
        } catch (\Exception $e) {
            var_dump($e);
        }
        header('location: /abonnement/list');
    }
    public function list($id)
    {
        try {
            //code...
        
        $role = '';
        // extract($_GET);
        if($this->user->getRole()->getNom()==='Gestionnaire Compteur') {
            $compeurNA = $this->em->createQuery("
            SELECT u
            FROM Compteur u
            WHERE u.etat !='deleted' and u.attribution is null
            
            ")->getResult();
            $role = 'gcpt';
        }
        $abonnements = isset($id) ?
            $this->em->getRepository('Abonnement')->findBy(array('etat' => 1, 'habitant' => $this->em->find('Habitant', $id))) :
            $this->em->getRepository('Abonnement')->findBy(array('etat' => 1,));
        return [
            'template' => 'abolist.html.php',
            'title' => 'liste des abonnements',
            'variables' => [
                'abonnements' => $abonnements,
                'compteurs' => $compeurNA??NULL,
                'role'=> $role??''

            ]
        ];
    } catch (\Exception $e) {
        echo $e;
    }
    }
    public function delete()
    {
        extract($_POST);
        foreach ($abonnements as $abo) {
            $this->em->find('Abonnement', $abo)->setEtat(0);
        }
        $this->em->flush();
        header('location: /abonnement/list');
    }
}
