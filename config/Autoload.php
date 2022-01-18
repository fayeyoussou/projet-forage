<?php
class Autoload
{
    static function Register()
    {
        spl_autoload_register(array(__CLASS__, "autoload"));
    }
    static function autoload($class)
    {
        try {// echo (str_replace( "\\","/",$class));
        if (file_exists("/../src/model/$class.php")) {
            require_once "/../src/model/$class.php";
        } else if (file_exists("/../src/controller/$class.php")) {
            require_once "/../src/controller/$class.php";
        // echo (str_replace( "\\","/",$class));
        } else if (file_exists("/../".str_replace( "\\","/",$class).".php")) {
            require_once str_replace( "\\","/",$class).".php";
        } } catch(\Exception $e) {
            die("merci d'utiliser use ".$class."error : ".$e);
        }
    }
}
Autoload::Register();
