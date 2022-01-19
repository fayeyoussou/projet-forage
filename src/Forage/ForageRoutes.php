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
        $routes = [
			'' => [
				'GET' => [
					'controller' => $default,
					'action' => 'home'
				]
			]
		];
        return $routes;
    }
    // public function authenticate(): \Youtech\Authentication {
    //     return new \Youtech\Authentication();
    // }
}