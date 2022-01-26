<?php

namespace Youtech;

class Authentication
{
    private $user;
    private $passwordColumnName;
    private $userColumnName;
    private $objectName;
    private array $stateCol;
    public function __construct($em,string $objectName,string $userColumnName,string $passwordColumnName,array $stateCol=NULL)
    {
        session_start();
        $this->objectName = $objectName;
        $this->userColumnName = $userColumnName;
        $this->passwordColumnName= $passwordColumnName;
        $this->em = $em;
        $this->stateCol = $stateCol;
        
    }
    private function getter () {
        return [
            'selectByOneUser'=>'findOneBy'.$this->userColumnName,
            'selectPassword'=>"get$this->passwordColumnName",
            'UserC'=>"get$this->userColumnName",
            'etatC'=>(isset($stateCol)? ("get".ucfirst($this->stateCol['name'])):"getEtat")
        ];
    }
    public function login($username, $password)
    {
        
        extract($this->getter());
        $user = $this->em->getRepository($this->objectName)->$selectByOneUser($username);
        if (!empty($user) && password_verify($password, $user->$selectPassword()) && $user->$etatC()==$this->stateCol['true']) {
            session_regenerate_id();
            $_SESSION['user'] = $user->$UserC();
            $_SESSION['password'] = $user->$selectPassword();
            // $_SESSION['id'] = $user->getId();
            return true;
        }
        else {
        $_SESSION = [];
        unset($_SESSION);
        session_destroy();
        // return $user;
        return false; }
    }
    public function getUser() {
        extract($this->getter());
        if($this->isLoggedIn()){
        return $this->em->getRepository($this->objectName)->$selectByOneUser($_SESSION['user']);
        } else return NULL;
    }
    public function isLoggedIn()
    {
        if (empty($_SESSION['user'])) {
            return false;
            return "session_vide";
        }
        extract($this->getter());
        $user=$this->em->getRepository($this->objectName)->$selectByOneUser($_SESSION['user']);
        $password=$user->$selectPassword();
        if (
                !empty($user) && 
                $password === $_SESSION['password'] && 
                $user->$etatC()
                ==$this->stateCol['true']
            ) {
            return true;
        } else {
            return false;
        }
        // return true;
    }
}
