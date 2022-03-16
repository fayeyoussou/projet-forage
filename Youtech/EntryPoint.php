<?php

namespace Youtech;

class EntryPoint
{
    private $route;
    private $method;
    private $routes;
    private $id;
    // private $em;
    public function __construct(string $route, \Youtech\Routes $routes, string $method)
    {
        $res = explode("/",$route);
        if(count($res) ==3) {
            $this->id = $res[2];
            $this->route = $res[0]."/".$res[1];
        }else {
            $this->id =null;
            $this->route = $route;
        }
        $this->checkUrl();
        $this->routes = $routes;
        $this->method = $method;
        // $this->em = $em;
    }
    private function checkUrl()
    {
        if ($this->route !== strtolower($this->route)) {
            http_response_code(301);
            header('location: ' . strtolower($this->route));
        }
    }
    private function loadTemplate($templateFileName, $variables = [])
    {
        extract($variables);
        ob_start();
        include __DIR__ . '/../templates/' . $templateFileName;
        return ob_get_clean();
    }

    public function run()
    {
        $routes = $this->routes->getRoutes();
        $authentication = $this->routes->getAuthentication();
        if(!isset($routes[$this->route])) header('location: /');
        else if (
            (
                isset($routes[$this->route]['login']) && 
                isset($routes[$this->route]['login']) &&
                !$authentication->isLoggedIn() 
            ) || (
                isset($routes[$this->route]['user'] ) && 
                !$this->routes->checkPermission($routes[$this->route]['user'])
                )
        ) {
            if(
                isset($routes[$this->route]['login']) && 
                isset($routes[$this->route]['login']) &&
                !$authentication->isLoggedIn() 
            ) header('location: /login/error');
            else header('location: /permission/error');
        } else if($authentication->isLoggedIn() && $this->route != 'user/password' && $this->route != 'user/logout' && password_verify('passer123',$authentication->getUser()->getPassword())){
            header('location: /user/password/'.$authentication->getUser()->getId());
        }
        
        else {
        $controller = $routes[$this->route][$this->method]['controller'];
        $action = $routes[$this->route][$this->method]['action'];
        $page = $controller->$action($this->id);
        $title = $page['title'];
        if (isset($page['variables'])) {
            $output = $this->loadTemplate(
                $page['template'],
                $page['variables']
            );
        } else {
            // echo "right here";
            $output = $this->loadTemplate($page['template']);
        }
        if ($authentication->isLoggedIn() )
        {
            
            $sidebar = $this->loadTemplate($this->routes->getRoleTemplate());

        }else $sidebar = '';
        
        echo $this->loadTemplate(
            'layout.html.php',
            [
                'log'=> $authentication->getUser(),
                'sidebar'=>$sidebar,
                'output' => $output,
                'title' => $title,
                
            ]
        );
         }
    }
}
