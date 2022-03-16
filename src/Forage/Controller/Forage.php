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
    public function loginError ()
    {
        return [
            'template'=>'loginerror.html.php',
            'title'=> 'Pas Connecte'
        ];
    } 
    public function PermissionError () {
        return [
            'template'=>'permissionerror.html.php',
            'title'=> 'Acces restreint'
        ];
    }
    public function dashboard() {
        return [
            'template'=>'dashboard.html.php',
            'title'=>'dashboard',
            'variables'=>[
                'user' => $this->authentication->getUser(),
            ]
        ];
    }
}