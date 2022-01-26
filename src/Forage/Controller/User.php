<?php

namespace src\Forage\Controller;

class User
{
    public function __construct($authentication, $em)
    {
        $this->authentication =  $authentication;
        $this->em = $em;
    }
    public function addUser($nom, $prenom, $email, $role, $password, $etat = 1)
    {
        try {
            $user = new \User();
            $user->setNom($nom);
            $user->setPrenom($prenom);
            $user->setEmail($email);
            $user->setRole($this->em->find('Role', $role));
            $user->setEtat(1);
            $user->setPassword(password_hash($password, PASSWORD_DEFAULT));
            $this->em->persist($user);
            $this->em->flush();
            return $user->getId();
        } catch (\Exception $e) {
            return $e;
            // return false;
        }
    }
    public function login()
    {



        $title = 'Formulaire De Connexion';
        return [
            'template' => 'login.html.php', 'title' => $title, 'variables' => [
                // 'test'=>$test,
            ],
        ];
    }
    // public function formUser()
    // {
    //     // $roles = [];
    //     $roles = $this->em->getRepository('Role')->findAll();
    //     $title = 'Ajouter Utilisateur';
    //     return [
    //         'template' => 'adduser.html.php',
    //         'title' => $title,
    //         'variables' =>
    //         [
    //             'roles' => $roles
    //         ]
    //     ];
    // }
    public function userCreate()
    {
        $roles = $this->em->getRepository('Role')->findAll();
        $title = 'Creation d\'utilisateur';
        return [
            'template' => 'usercreate.html.php', 'title' => $title, 'variables' => [
                'roles' => $roles
            ],
        ];
    }
    public function userSubmit()
    {
        extract($_POST);
        $res = $this->addUser($user['nom'], $user['prenom'], $user['email'], $user['role'], $user['password']);
        $title = 'Formulaire De Connexion';
        header('location: /user/list');
    }
    public function list()
    {
        $users = $this->em->createQuery('
        SELECT u
        FROM USER u
        WHERE u.role != 1 and u.etat = 1
        ')->getResult();
        // $users = $this->em->getRepository('User')->findBy(array('etat'=>1));
        $title = 'liste des utilisateurs';
        return [
            'template' => 'listuser.html.php',
            'title' => $title,
            'variables' =>
            [
                'users' => $users
            ]
        ];
    }
    public function delete()
    {
        extract($_POST);
        foreach ($users as $user) {
            $this->em->find('User',$user)->setEtat(0);
        }
        $this->em->flush();
        header('location: /user/list');
    }

    public function submitLogin()
    {
        extract($_POST);
        if ($this->authentication->login($login['email'], $login['password']))
            header('location: /');
        else header('location: /login/error');
    }
    public function testpost(){
        return [
            'template' => 'test.html.php',
            'title' => 'test',
            'variables'=>
            [
                'post'=>$_POST
            ]
            ];
    }
    public function testget(){
        return [
            'template' => 'test.html.php',
            'title' => 'test',
            'variables'=>
            [
                'post'=>$_POST
            ]
            ];
    }
}
