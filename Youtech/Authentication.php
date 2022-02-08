<?php

namespace Youtech;

class Authentication
{
    private $user;
    private $passwordColumnName;
    private $userColumnName;
    private $objectName;
    private array $stateCol;
    public function __construct($em, string $objectName, string $userColumnName, string $passwordColumnName, array $stateCol = [])
    {
        session_start();
        $this->objectName = $objectName;
        $this->userColumnName = $userColumnName;
        $this->passwordColumnName = $passwordColumnName;
        $this->em = $em;
        $this->stateCol = $stateCol;
    }
    private function getter()
    {
        $getu = [
            'selectByOneUser' => 'findOneBy' . $this->userColumnName,
            'selectPassword' => "get$this->passwordColumnName",
            'UserC' => "get$this->userColumnName",
            // 'etatC'=>"get".ucfirst($this->stateCol['name'])
        ];
        if (isset($this->stateCol['name']) && isset($this->stateCol['true'])) {
            $getu = [
                'selectByOneUser' => 'findOneBy' . $this->userColumnName,
                'selectPassword' => "get$this->passwordColumnName",
                'UserC' => "get$this->userColumnName",
                'etatC' => "get" . ucfirst($this->stateCol['name'])
            ];
        }
        return $getu;
    }
    public function login($username, $password)
    {
        extract($this->getter());
        var_dump($this->stateCol);
        echo "<br>[" . $etatC . " ceci";
        $user = $this->em->getRepository($this->objectName)->$selectByOneUser($username);
        if (
            !empty($user) &&
            password_verify($password, $user->$selectPassword())
            && $user->$etatC() ==
            $this->stateCol['true']
        ) {
            session_regenerate_id();
            $_SESSION['user'] = $user->$UserC();
            $_SESSION['password'] = $user->$selectPassword();
            // $_SESSION['id'] = $user->getId();
            return true;
        } else {
            $this->logout();
            return false;
        }
    }
    public function getUser()
    {

        extract($this->getter());
        if ($this->isLoggedIn()) {
            $this->user = $this->em->getRepository($this->objectName)->$selectByOneUser($_SESSION['user']);
            return $this->user;
        } else return NULL;
    }
    public function isLoggedIn()
    {
        if (empty($_SESSION['user'])) {
            return false;
            return "session_vide";
        }
        extract($this->getter());
        $this->user = $this->em->getRepository($this->objectName)->$selectByOneUser($_SESSION['user']);
        $password = $this->user->$selectPassword();
        if (
            !empty($this->user) &&
            $password === $_SESSION['password'] &&
            (
                isset($this->stateCol['true']) ||
                $this->user->$etatC() == $this->stateCol['true']
            )
        ) {
            return true;
        } else {
            $this->logout();
            return false;
        }
        // return true;
    }
    public function logout () {
        $_SESSION = [];
        unset($_SESSION);
        session_destroy();
        $this->user = null;
    }
}
