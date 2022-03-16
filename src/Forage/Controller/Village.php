<?php
namespace src\Forage\Controller;
class Village {
    private $em;
    private $user;
    public function __construct ($em,$user) {
        $this->em = $em;
        $this->user = $user;
    }
    
    public function creervillage ($id){
        $clients = $this->em->getRepository('Habitant')->findAll();
        $toturn = [
            'template'=> 'villagecreate.html.php',
            'title'=> 'Creation de village',
            'variables'=> [
                'clients'=> $clients,
            ]
        ];
        if(isset($id)) $toturn['variables']['village'] = $this->em->find('Village',$id);
        return $toturn;
        
    }
    public function submitvillage(){
        extract($_POST);
        // var_dump($village);
        if(isset($village['etat'])) $village2 = $this->em->find('Village',$village['etat']);
        else {
            $village2 = new \Village();
            $village2->setUser($this->user);
        }

        if(!empty($village['chef'])) $village2->setChefVillage($this->em->find('Habitant',$village['chef']));
        else $village2->setChefVillage(NULL);
        $village2->setNom( $village['nom']);
        $village2->setEtat(1);
        
        if(!isset($village['etat']))$this->em->persist($village2);
        $this->em->flush();
        header('location: /village/list');
    }
    public function listervillage()
    {
        $villages =  $this->em->createQuery('
        SELECT v
        FROM Village v
        WHERE v.etat = 1
        ')->getResult();
        foreach ($villages as $village) {
            $id = $village->getId();
            $village->nbrHabitant= $this->em->createQuery("
            SELECT count(h)
            FROM Habitant h
            WHERE h.village = $id
            ")->getResult();
        }
        return [
            'template'=> 'listevillage.html.php',
            'title'=> 'liste des villages',
            'variables'=>[
            'villages'=>$villages]
        ];
    }
    public function delete (){
        extract($_POST);
        foreach ($villages as $village) {
            $this->em->find('Village', $village)->setEtat(0);
        }
        $this->em->flush();
        header('location: /village/list');
    }

}