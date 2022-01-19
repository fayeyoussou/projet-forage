<?php
namespace src\Forage\Controller;
class User {
    public function __construct()
    {
        
    }
    public function Login () 
    {
        $title = 'Formulaire De Connexion';

        return ['template' => 'login.html.php', 'title' => $title];
    }
    public function signup ()
    {
        $title = 'Formulaire d\'inscription';
        return ['template' => 'signup.html.php','title'=> $title];
    }
    public function submitlogin ()
    {

    }
}