<?php

namespace src\Forage;

class ForageRoutes implements \Youtech\Routes
{
    private $em;
    private $authentication;
    public function __construct($em)
    {
        $this->em = $em;
        $this->authentication = new \Youtech\Authentication($this->em, 'User', 'Email', 'Password',array('name'=>'Etat','true'=>1));
    }
    public function checkPermission($permission): bool
    {
        return $permission == ($this->authentication->getUser()->getRole()->getNom());
    }
    public function getRoutes(): array
    {
        $default = new \src\Forage\Controller\Forage($this->authentication);
        $userController = new \src\Forage\Controller\User($this->authentication, $this->em);
        $routes = [
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
                'user'=>'Admin'
            ],
            'user/profil' => [
                'GET' => [
                    'controller' => $userController,
                    'action' => 'showprofil'
                ]
            ],
            'user/delete' => [
                'POST' => [
                    'controller' => $userController,
                    'action' => 'delete'
                ],
                'login' => true,
                'user'=>'Admin'
            ],
            'login/error'=>[
                'GET'=>[
                    'controller'=>$default,
                    'action'=> 'loginError'
                ]
                ],
                'permission/error'=>[
                    'GET'=>[
                        'controller'=>$default,
                        'action'=> 'PermissionError'
                    ]
                ]
        ];
        return $routes;
    }
    public function getAuthentication(): \Youtech\Authentication
    {
        return $this->authentication;
    }
}
