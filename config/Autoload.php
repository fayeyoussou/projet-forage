<?php
function autoloader($className)
{
    $fileName = str_replace('\\', '/', $className) . '.php';
    $file = __DIR__ . '/../' . $fileName;
    if(!file_exists($file)){
        $file = __DIR__ .'/../src/Entities/'.$className.'.php';
    }
    include $file;
}
spl_autoload_register('autoloader');