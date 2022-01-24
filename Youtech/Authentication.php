<?php

namespace Youtech;

class Authentication
{
    private $user;
    private $passwordColumnName;
    private $userColumnName;
    private $objectName;
    public function __construct($em,$objectName,$userColumnName,$passwordColumnName)
    {
        session_start();
        $this->objectName = $objectName;
        $this->userColumnName = $userColumnName;
        $this->passwordColumnName= $passwordColumnName;
        $this->em = $em;
        
    }
    private function getter () {
        return [
            'byOne'=>'findOneBy'.$this->userColumnName,
            'PasswordC'=>"get$this->passwordColumnName",
            'UserC'=>"get$this->userColumnName"
        ];
    }
    public function login($username, $password)
    {
        
        extract($this->getter());
        $user = $this->em->getRepository($this->objectName)->$byOne($username);
        if (!empty($user) && password_verify($password, $user->$PasswordC())) {
            session_regenerate_id();
            $_SESSION['user'] = $user->$UserC();
            $_SESSION['password'] = $user->$PasswordC();
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
        if ($this->isLoggedIn()) {
        return $this->users->find($this->usernameColumn,
        strtolower($_SESSION['username']))[0]; }
            else {
                return false;
        } 
    }
    public function isLoggedIn()
    {
        if (empty($_SESSION['user'])) {
            return false;
            return "session_vide";
        }
        extract($this->getter());
        $user=$this->em->getRepository($this->objectName)->$byOne($_SESSION['user']);
        $password=$user->$PasswordC();
        // // $passwordColumn = $this->passwordColumn;
        // // use brace to avoid error cause php read left to right and will try to find 
        // // $user->$this it will be an error
        if (!empty($user) && $password === $_SESSION['password']) {
            return true;
        } else {
            return false;
        }
        // return true;
    }
}
