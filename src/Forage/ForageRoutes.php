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
        return $permission == ($this->authentication->getUser()->getRole()->getNom());
    }
    public function getRoutes(): array
    {
        $default = new \src\Forage\Controller\Forage($this->authentication);
        $userController = new \src\Forage\Controller\User($this->authentication, $this->em);
        $villageController = new \src\Forage\Controller\Village($this->em, $this->authentication->getUser());
        $clientController = new \src\Forage\Controller\Client($this->em, $this->authentication->getUser());
        return [
            '' => [
                'GET' => [
                    'controller' => $default,
                    'action' => 'home'
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
            ],
            'user/list' =>
            [
                'GET' => [
                    'controller' => $userController,
                    'action' => 'list'
                ],
                'login' => true,
                'user' => 'Admin'
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
                'user' => 'Admin'
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
                'user' => 'Gestionnaire Clientele'
            ],
            'village/list' => [
                'GET' => [
                    'controller' => $villageController,
                    'action' => 'listervillage'
                ],
                'login' => true,
                'user' => 'Gestionnaire Clientele'
            ],
            'village/delete' => [
                'POST' => [
                    'controller' => $villageController,
                    'action' => 'delete'
                ],
                'login' => true,
                'user' => 'Gestionnaire Clientele'
            ],


            'client/manage' => [
                'GET' => [
                    'controller' => $clientController,
                    'action' => 'creerClient'
                ]
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
        // echo "roletemplate";
        // if ($this->authentication->isLoggedIn())
        return str_replace(' ', '', strtolower($this->authentication->getUser()->getRole()->getNom())) . ".html.php";
        // else return 'empty.html.php'; 
    }
    public function getAuthentication(): \Youtech\Authentication
    {
        return $this->authentication;
    }
}
