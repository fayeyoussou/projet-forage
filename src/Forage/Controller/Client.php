<?php

namespace src\Forage\Controller;

class Client
{
    private $em;
    private $user;
    public function __construct($em, $user)
    {
        $this->em = $em;
        $this->user = $user;
    }
    public function creerClient($id)
    {
        $villages =  $this->em->createQuery('
        SELECT v
        FROM Village v
        WHERE v.etat = 1
        ')->getResult();

        $toreturn = [
            'template' => 'clientcreate.html.php', 'title' => 'liste des clients',
            'variables' => [
                'villages' => $villages
            ]
        ];
        if (isset($id)) $toreturn['variables']['client'] = $this->em->find('Habitant', $id);
        return $toreturn;
    }
    public function clientSubmit()
    {
        try {
        extract($_POST);
        // var_dump($client);
        if (isset($client['etat'])) {
            echo "<br>la bas";
            $clientToSet = $this->em->find('Habitant', $client['etat']);
        }
        else {
            echo "<br>ici";
            $clientToSet = new \Habitant();
            $clientToSet->setUser($this->user);
        }
        $clientToSet->setAdresse($client['adresse']);
        $clientToSet->setTelephone($client['telephone']);
        $clientToSet->setNom($client['nom']);
        $clientToSet->setVillage($this->em->find('Village', $client['village']));
        $clientToSet->setEtat(1);
        if (!isset($client['etat'])) {
            $this->em->persist($clientToSet);
            echo "<br>persist called<br>";
        }
        // var_dump($clientToSet);
        $this->em->flush();
        echo $clientToSet->getId();
        header('location: /client/list');}
        catch (\Exception $e) {
            echo "Exception : <br>-----------------------------<br>".$e;
        }      
    }
    public function list()
    {
        $clients =  $this->em->createQuery('
        SELECT v
        FROM Habitant v
        WHERE v.etat = 1
        ')->getResult();
        return [
            'template' => 'listeclients.html.php',
            'title' => 'liste des clients',
            'variables' => [
                'clients' => $clients
            ]
        ];
    }
}
