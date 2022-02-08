<?php

namespace src\Forage\Controller;

class User
{
    public function __construct($authentication, $em)
    {
        $this->authentication =  $authentication;
        $this->em = $em;
    }
    public function addUser($nom, $prenom, $email, $role, $password,$extension, $etat = 1)
    {
        try {
            $user = new \User();
            $user->setNom($nom);
            $user->setPrenom($prenom);
            $user->setEmail($email);
            $user->setRole($this->em->find('Role', $role));
            $user->setEtat(1);
            $user->setPassword(password_hash($password, PASSWORD_DEFAULT));
            $user->setExtension($extension);
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
        if($this->authentication->isLoggedIn() &&( $this->authentication->getUser()->getRole()->getId()==1 || $this->authentication->user->getId()==$_GET['id'])){
        if (isset($_GET['id'])) {
            $user = $this->em->find('User', $_GET['id']);
            $title = 'Modifier le profil d\'utilisateur';
            return [
                'template' => 'usercreate.html.php', 'title' => $title, 'variables' => [
                    'roles' => $roles,
                    'user' => $user
                ],
            ];
        }
        $title = 'Creation d\'utilisateur';
        return [
            'template' => 'usercreate.html.php', 'title' => $title, 'variables' => [
                'roles' => $roles
            ],
        ];} else return [
            'template'=> 'permissionerror.html.php'
        ];
    }
    public function userSubmit()
    {

        extract($_POST);
        $typeext = explode("/",$_FILES['user']['type']['image']);

        
            
        if ($user['etat'] == 0) {
            $usert = $this->addUser($user['nom'], $user['prenom'], $user['email'], $user['role'], $user['password'],$typeext[1]);
            // header('location: /user/list');

        } else {
            $usert = $this->setUser($user,$typeext[1]);
            // header('location: /user/list');

        }
        $target = "resources/userimage/user-".$usert.".".$typeext[1];
        var_dump ( $_FILES['user']['tmp_name']);
        if($typeext[0]=='image' && 
        move_uploaded_file($_FILES['user']['tmp_name']['image'],$target)){
        header('location: /user/list');
            
        }
        // $title = 'Formulaire De Connexion';
    }
    public function setUser($user,$extension)
    {
        $userm = $this->em->find('User', $user['etat']);
        $userm->setNom($user['nom']);
        $userm->setPrenom($user['prenom']);
        $userm->setEmail($user['email']);
        $userm->setRole($this->em->find('Role', $user['role']));
        $userm->setExtension($extension);
        $this->em->flush();
        return $userm->getId();
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
            $this->em->find('User', $user)->setEtat(0);
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
    public function testpost()
    {
        return [
            'template' => 'test.html.php',
            'title' => 'test',
            'variables' =>
            [
                'post' => $_POST
            ]
        ];
    }
    public function showprofil()
    {
        $user = "";
        if (isset($_GET['id'])) {
            $user = $this->em->find('User', $_GET['id']);
        } else {
            $user = $this->authentication->getUser();
        }
        return [
            'template' => 'profiluser.html.php',
            'title' => "profil de $user->getPrenom() $user->getNom()",
            'variables' =>
            [
                'userProfil' => $user
            ]
        ];
    }
    public function testget()
    {
        return [
            'template' => 'test.html.php',
            'title' => 'test',
            'variables' =>
            [
                'post' => $_POST
            ]
        ];
    }
    public function logout (){

    }
}
