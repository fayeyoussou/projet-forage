<?php

namespace src\Forage;

class ForageRoutes implements \Youtech\Routes
{
    private $em;
    private $authentication;
    public function __construct($em)
    {
        $this->em = $em;
        $this->authentication = new \Youtech\Authentication($this->em, 'User', 'Email', 'Password', array('name' => 'Etat', 'true' => 1));
    }
    public function checkPermission($permission): bool
    {
        return in_array(($this->authentication->getUser()->getRole()->getNom()), $permission);
    }
    public function getRoutes(): array
    {
        $default = new \src\Forage\Controller\Forage($this->authentication);
        $userController = new \src\Forage\Controller\User($this->authentication, $this->em);
        $villageController = new \src\Forage\Controller\Village($this->em, $this->authentication->getUser());
        $clientController = new \src\Forage\Controller\Client($this->em, $this->authentication->getUser());
        $abonnementController = new \src\Forage\Controller\Abonnement($this->em, $this->authentication->getUser());
        $compteurController = new \src\Forage\Controller\Compteur($this->em, $this->authentication->getUser());
        $consommationController = new \src\Forage\Controller\Consommation($this->em,$this->authentication->getUser());
        $factureController = new \src\Forage\Controller\Facture($this->em,$this->authentication->getUser());
        return [
            '' => [
                'GET' => [
                    'controller' => $default,
                    'action' => 'home'
                ]
            ],
            'home/dashboard' =>
            [
                'GET' => [
                    'controller' => $default,
                    'action' => 'dashboard'
                ]
            ],
            'test/youssou' =>
            [
                'POST' => [
                    'controller' => $userController,
                    'action' => 'testpost'
                ],
                'GET' => [
                    'controller' => $userController,
                    'action' => 'testget'
                ]
            ],
            'login/signin' =>
            [
                'GET' => [
                    'controller' => $userController,
                    'action' => 'login'
                ],
                'POST' => [
                    'controller' => $userController,
                    'action' => 'submitLogin'
                ],
                // 'login'=>true,
            ],
            'login/error' => [
                'GET' => [
                    'controller' => $default,
                    'action' => 'loginError'
                ]
            ],


            'user/manage' =>
            [
                'GET' => [
                    'controller' => $userController,
                    'action' => 'userCreate'
                ],
                'POST' => [
                    'controller' => $userController,
                    'action' => 'userSubmit'
                ],
                'login' => true,
                'user' => ['Admin']
            ],
            'user/list' =>
            [
                'GET' => [
                    'controller' => $userController,
                    'action' => 'list'
                ],
                'login' => true,
                'user' => ['Admin']
            ],
            'user/profil' => [
                'GET' => [
                    'controller' => $userController,
                    'action' => 'userCreate'
                ]
            ],
            'user/delete' => [
                'POST' => [
                    'controller' => $userController,
                    'action' => 'delete'
                ],
                'login' => true,
                'user' => ['Admin']
            ],
            'user/logout' => [
                'GET' => [
                    'controller' => $userController,
                    'action' => 'logout'
                ],
            ],



            'village/manage' =>
            [
                'GET' => [
                    'controller' => $villageController,
                    'action' => 'creervillage'
                ],
                'POST' => [
                    'controller' => $villageController,
                    'action' => 'submitvillage'
                ],
                'login' => true,
                'user' => ['Gestionnaire Clientele']
            ],
            'village/list' => [
                'GET' => [
                    'controller' => $villageController,
                    'action' => 'listervillage'
                ],
                'login' => true,
                'user' => ['Gestionnaire Clientele']
            ],
            'village/delete' => [
                'POST' => [
                    'controller' => $villageController,
                    'action' => 'delete'
                ],
                'login' => true,
                'user' => ['Gestionnaire Clientele']
            ],


            'client/manage' => [
                'GET' => [
                    'controller' => $clientController,
                    'action' => 'creerClient'
                ],
                'POST' => [
                    'controller' => $clientController,
                    'action' => 'clientSubmit'
                ],
                'login' => true,
                'user' => ['Gestionnaire Clientele']
            ],
            'client/list' => [
                'GET' => [
                    'controller' => $clientController,
                    'action' => 'list'
                ],
                'login' => true,
                'user' => ['Gestionnaire Clientele']
            ],


            'abonnement/manage' => [
                'GET' => [
                    'controller' => $abonnementController,
                    'action' => 'createabonnement'
                ],
                'POST' => [
                    'controller' => $abonnementController,
                    'action' => 'abonnementSubmit'
                ],
                'login' => true,
                'user' => ['Gestionnaire Clientele']
            ],
            'abonnement/list' => [
                'GET' => [
                    'controller' => $abonnementController,
                    'action' => 'list'
                ],
                'login' => true,
                'user' => ['Gestionnaire Clientele', 'Gestionnaire Compteur']
            ],
            'abonnement/delete' =>
            [
                'POST' => [
                    'controller' => $abonnementController,
                    'action' => 'delete'
                ],
                'login' => true,
                'user' => ['Gestionnaire Clientele']
            ],



            'compteur/new' => [
                'GET' => [
                    'controller' => $compteurController,
                    'action' => 'addnew'
                ],
                'login' => true,
                'user' => ['Gestionnaire Compteur']
            ],
            'compteur/assign' =>
            [
                'POST' => [
                    'controller' => $compteurController,
                    'action' => 'attribuer'
                ],
                'login' => true,
                'user' => ['Gestionnaire Compteur']
            ],
            'compteur/list'=>[
                'GET'=> [
                    'controller' => $compteurController,
                    'action'=> 'list'
                ],
                'login' => true,
                'user' => ['Gestionnaire Compteur','Gestionnaire Commercial']
            ],
            'compteurs/delete'=>[
                'POST'=>[
                    'controller'=>$compteurController,
                    'action'=>'delete'
                ],
                'login' => true,
                'user' => ['Gestionnaire Compteur']
            ],



            'compteur/consommation'=>
            [
                'GET'=>[
                    'controller'=>$consommationController,
                    'action' => 'toList'
                ],
                'login'=> true,
                'user'=> ['Gestionnaire Commercial']
            ],
            'consommation/add'=>[
                'GET'=>[
                    'controller'=>$consommationController,
                    'action'=> 'addCForm'
                ],
                'POST'=>[
                    'controller'=>$consommationController,
                    'action'=> 'valideC'
                ]
                ,
                'login'=> true,
                'user'=> ['Gestionnaire Commercial']
            ],


            'facture/generate'=>[
                'POST'=>[
                    'controller'=> $factureController,
                    'action'=> 'generateFacture'
                ],
                'login'=> true,
                'user'=> ['Gestionnaire Commercial']
            ],


            'permission/error' => [
                'GET' => [
                    'controller' => $default,
                    'action' => 'PermissionError'
                ]
            ],

        ];
    }
    public function getRoleTemplate(): string
    {
        return str_replace(' ', '', strtolower($this->authentication->getUser()->getRole()->getNom())) . ".html.php";
    }
    public function getAuthentication(): \Youtech\Authentication
    {
        return $this->authentication;
    }
}
