<?php

namespace libs\system;

class BootStrap
{
    public function __construct()
    {
        if (isset($_GET["url"])) {
            $url = explode("/", $_GET["url"]);
            $controller_file = "src/controller/" . $url[0] . "Controller.php";
            if (file_exists($controller_file)) {
                // $varName = ;
                $controllerObject = new ("\\src\\controller\\$url[0]" . "Controller")();
                // $controller->hello();
                if (isset($url[1])) {
                    $method = $url[1];
                    if (method_exists($controllerObject, $url[1])) {
                        $controllerObject->$method($url[2]??[]);
                    } else echo "$url[0]Controller doesn't have a methode named $method";
                }
            } else echo ("$controller_file n'existe pas");
            // echo $url[0];
        } else {
            echo "MVC";
        }
    }
}
