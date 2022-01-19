<?php
namespace src\Forage;
class ForageRoutes implements \Youtech\Routes {
    public function __construct () {

    }
    public function checkPermission($permission): bool {
        return true ;
    }
    public function getRoutes(): array {
        $default = new \src\Forage\Controller\Forage();
        $userController = new \src\Forage\Controller\User();
        $routes = [
			'' => [
				'GET' => [
					'controller' => $default,
					'action' => 'home'
				]
                ],
            'login/signin' => 
            [
                'GET'=> [
                    'controller' => $userController,
                    'action'=> 'login'
                ],
                'POST'=> [
                    'controller'=> $userController,
                    'action' => 'submitlogin'
                ]
            ]
		];
        return $routes;
    }
    // public function authenticate(): \Youtech\Authentication {
    //     return new \Youtech\Authentication();
    // }
}