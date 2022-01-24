<?php

namespace Youtech;

class EntryPoint
{
    private $route;
    private $method;
    private $routes;
    private $em;
    public function __construct(string $route, \Youtech\Routes $routes, string $method)
    {
        $this->route = $route;
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
        // $isl= $authentication->isLoggedIn();
        if (
            isset($routes[$this->route]['login'])
            && isset($routes[$this->route]['login']) &&
            !$authentication->isLoggedIn()
        ) {
            header('location: /login/error');
        }
        $controller = $routes[$this->route][$this->method]['controller'];
        $action = $routes[$this->route][$this->method]['action'];
        $page = $controller->$action();
        $title = $page['title'];
        // $page['variables']['test']=$isl;
        if (isset($page['variables'])) {
            $output = $this->loadTemplate(
                $page['template'],
                $page['variables']
            );
        } else {
            $output = $this->loadTemplate($page['template']);
        }
        
        echo $this->loadTemplate(
            'layout.html.php',
            [
                'output' => $output,
                'title' => $title,
            ]
        );
        // }
    }
}
