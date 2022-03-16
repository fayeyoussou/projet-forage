<?php

namespace src\Forage\Controller;
    
    
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mime\Email;
class User
{
    
    public function __construct($authentication, $em)
    {
        $this->authentication =  $authentication;
        $this->em = $em;
    }
    public function addUser($nom, $prenom, $email, $role, $extension, $etat = 1)
    {
        try {
            $user = new \User();
            $user->setNom($nom);
            $user->setPrenom($prenom);
            $user->setEmail($email);
            $user->setRole($this->em->find('Role', $role));
            $user->setEtat(1);
            $user->setPassword('passer123');
            $user->setExtension($extension);
            $this->em->persist($user);
            $this->em->flush();

            return $user->getId();

        } catch (\Throwable $e) {
            // return $e;
            // return false;
        }
    }
    public function login()
    {



        $title = 'Formulaire De Connexion';
        return [
            'template' => 'login.html.php',
            'title' => $title
        ];
    }
    public function userCreate($id)
    {
        
        $roles = $this->em->getRepository('Role')->findAll();
        if ($this->authentication->isLoggedIn() && ($this->authentication->getUser()->getRole()->getId() == 1 || $this->authentication->user->getId() == $id)) {
            if (isset($id)) {
                $user = $this->em->find('User', $id);
                
                $title = 'Modifier le profil de ' . $user->getPrenom() . ' ' . $user->getNom();
                return [
                    'template' => 'usercreate.html.php', 'title' => $title, 'variables' => [
                        'roles' => $roles,
                        'user' => $user,
                        'connected' => $this->authentication->user->getId()
                    ],
                ];
            }
            $title = 'Creation d\'utilisateur';
            return [
                'template' => 'usercreate.html.php', 'title' => $title, 'variables' => [
                    'roles' => $roles,
                    'connected' => $this->authentication->user->getId()
                ],
            ];
        } else return [
            'template' => 'permissionerror.html.php'
        ];

    }
    public function userSubmit()
    {

        extract($_POST);
        $typeext = explode("/", $_FILES['user']['type']['image']);



        if ($user['etat'] == 0) {
            $usert = $this->addUser($user['nom'], $user['prenom'], $user['email'], $user['role'], $typeext[1]);
            $target = "resources/userimage/user-" . $usert . "." . $typeext[1];
            $typeext[0] == 'image' ? move_uploaded_file($_FILES['user']['tmp_name']['image'], $target) : "";
            

        } else {
            $usert = $this->setUser($user);
            // header('location: /user/list');

        }
        
        
        if($this->authentication->getUser()->getId() == $user['etat'])
        header('location: /home/dashboard');
        else header('location: /user/list');
        
        // $title = 'Formulaire De Connexion';
    }
    public function setUser($user)
    {
        $userm = $this->em->find('User', $user['etat']);
        $userm->setNom($user['nom']);
        $userm->setPrenom($user['prenom']);
        $userm->setEmail($user['email']);
        if (isset($user['role'])) $userm->setRole($this->em->find('Role', $user['role']));
        // $userm->setExtension($extension);
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
    public function changePassword ($id) {
        return [
            'template' => 'passwordchange.html.php',
            'title' => 'changement de mot de passe',
            'variables'=> [
                'id'=>$id
            ]
        ];
    }
    public function submitChangePassword(){
        extract($_POST);
        // var_dump($_POST);
        $good = true;
        $err = '';
        if($password['new'] != $password['repeat']) {
            $err.= "les deux mots de passe ne correspondent pas";
            $good = false;
        }
        if(!password_verify($password['old'],$this->authentication->getUser()->getPassword())){
            $err.= "anciens pass incorrect";
            $good = false;
        }
        if($good){
            if($this->authentication->isLoggedIn()){
            $user = $this->em->find('User',$this->authentication->getUser()->getId());
            } else if(isset($password['id'])) {
                $user = $this->em->find('User',$password['id']);
            }
            $user->setPassword($password['new']);
            $this->em->flush();
        }else {
            
            return [
                'template' => 'passwordchange.html.php',
                'title' => 'changement de mot de passe',
                'variables'=>[
                    'err'=> $err,
                    'id'=>$password['id'] ?? null
                ]
            ];
        }
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
    public function logout()
    {
        $this->authentication->logout();
        header('location: /login/signin');
    }
}
