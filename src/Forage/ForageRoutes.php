<?php

namespace src\Forage;

class ForageRoutes implements \Youtech\Routes
{
    private $em;
    private $authentication;
    public function __construct($em)
    {
        $this->em = $em;
        $this->authentication = new \Youtech\Authentication($this->em, 'User', 'Email', 'Password');
    }
    public function checkPermission($permission): bool
    {
        return true;
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
                'login'=>true,
            ],
            'user/create' =>
            [
                'GET' => [
                    'controller' => $userController,
                    'action' => 'userCreate'
                ],
                'POST' => [
                    'controller' => $userController,
                    'action' => 'userSubmit'
                ],
                'login'=>true,
            ],
            'user/list'=>
            [
                'GET'=>[
                    'controller'=>$userController,
                    'action'=> 'list'
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
