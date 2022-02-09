<?php
namespace src\Forage\Controller;
class Client {
    private $em;
    private $user;
    public function __construct($em,$user){
        $this->em = $em;
        $this->user=$user;
    }
    public function creerClient(){
        $villages =  $this->em->createQuery('
        SELECT v
        FROM Village v
        WHERE v.etat = 1
        ')->getResult();

        $toreturn = [
            'template'=> 'clientcreate.html.php'
            ,'title'=>'liste des clients',
            'variables'=>[
                'villages'=>$villages
            ]
        ];
        if(isset($_GET['id'])) $toreturn ['variables']['client']= $this->em->find('Habitant',$_GET['id']);
        return $toreturn;
    }
    public function clientSubmit(){
        extract($_POST);
        if(isset($client['etat'])) $clientToSet = $this->em->find('Client',$client['etat']);
        else 
        {
            $clientToSet = new \Habitant();
            $clientToSet->setUser($this->user);
        }
        
    }
}