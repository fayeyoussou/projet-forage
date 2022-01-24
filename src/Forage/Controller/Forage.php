<?php 
namespace src\Forage\Controller;
class Forage {
    private $authentication;
    public function __construct($authentication)
    {
        $this->authentication = $authentication;
    }
    public function home () {
        http_response_code(301);
        if(!$this->authentication->isLoggedIn()) header('location: /login/signin');
        else header('location: /home/dashboard');
    }
}