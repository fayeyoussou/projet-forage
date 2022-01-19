<?php

namespace Youtech;

class EntryPoint
{
    private $route;
    private $method;
    private $routes;
    public function __construct(string $route, \Youtech\Routes $routes, string $method)
    {
        $this->route = $route;
        $this->checkUrl();
        $this->routes = $routes;
        $this->method = $method;
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
        $controller = $routes[$this->route][$this->method]['controller'];
        $action = $routes[$this->route][$this->method]['action'];
        $page = $controller->$action();
        $title = $page['title'];

        if (isset($page['variables'])) {
            $output = $this->loadTemplate(
                $page['template'],
                $page['variables']
            );
        } else {
            $output = $this->loadTemplate($page['template']);
        }
        // echo $this->loadTemplate('header.html.php');
        echo $this->loadTemplate(
            'layout.html.php',
            [
                // 'loggedIn' => $authentication->isLoggedIn(),
                'output' => $output,
                'title' => $title
            ]
        );
        // }
    }
}
