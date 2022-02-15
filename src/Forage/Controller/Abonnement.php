<?php

namespace src\Forage\Controller;

class Abonnement extends Numero
{
    public function __construct($em, $user)
    {
        parent::__construct($em,$user);
    }
    public function createabonnement()
    {
        $clients =  $this->em->createQuery('
        SELECT v
        FROM Habitant v
        WHERE v.etat = 1
        ')->getResult();
        if (isset($_GET['id'])) {
            $abonnement = $this->em->find('Abonnement', $_GET['id']);
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
            $num = $this->em->find('Numero', 'abo');
            $periode = (new \DateTime())->format('ym');
            if (!$num->getPeriode() == $periode) {
                $num->setNumero(0);
                $num->setPeriode($periode);
            }
            $num->setNumero($num->getNumero() + 1);
            $abo->setNumero('AB' . $periode . sprintf("%04d", $num->getNumero()));
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
    public function list()
    {
        $role = '';
        extract($_GET);
        if($this->user->getRole()->getNom()==='Gestionnaire Compteur') {
            $compeurNA = $this->em->getRepository('Compteur')->findBy(array('attribution'=>NULL));
            $role = 'gcpt';
        }
        $abonnements = isset($_GET['id']) ?
            $this->em->getRepository('Abonnement')->findBy(array('etat' => 1, 'habitant' => $this->em->find('Habitant', $id))) :
            $this->em->getRepository('Abonnement')->findBy(array('etat' => 1,));
        return [
            'template' => 'abolist.html.php',
            'title' => 'liste des abonnements',
            'variables' => [
                'abonnements' => $abonnements,
                'compteurs' => $compeurNA,
                'role'=> $role

            ]
        ];
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
