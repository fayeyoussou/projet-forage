<?php
// include_once "../bootstrap.php";
// $h = $entityManager->getRepository("habitant")->findAll();
// var_dump($h[0]->getAdresse());
// // $h[0];
    

// // var_dump($habitant);

try {
    // fonction autoload qui permet de charger automatiquement 
    // les classes sans faires d'includes
    include __DIR__ . '/../bootstrap.php';
    include __DIR__ . '/../config/autoload.php';
    // $con = (new \src\Utility\ChiffreEnLettres())->Conversion(345);
    // echo "----------------------------------------------------".$con;
    /**
     * Commence a charger a partir du premier / et se termine a 
     * la fin ou stoppe au premier point d'interrogation
     */
    $pro = $entityManager->find('Promo',1);
    
    $route = ltrim(strtok($_SERVER['REQUEST_URI'], '?'), '/');
    // echo password_hash('passer123',PASSWORD_DEFAULT);
    $entryPoint = new \Youtech\entryPoint($route,new \src\Forage\ForageRoutes($entityManager),$_SERVER['REQUEST_METHOD']);
    $entryPoint->run();
} catch (\Exception $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine();
}
