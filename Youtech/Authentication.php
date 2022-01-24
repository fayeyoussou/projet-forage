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
        extract($this->getter());
        if($this->isLoggedIn()){
        return $this->em->getRepository($this->objectName)->$byOne($_SESSION['user']);
        } else return NULL;
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
        if (!empty($user) && $password === $_SESSION['password']) {
            return true;
        } else {
            return false;
        }
        // return true;
    }
}
