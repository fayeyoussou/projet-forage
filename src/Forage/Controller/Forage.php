<?php 
namespace src\Forage\Controller;
class Forage {
    public function home () {
        $title = 'Internet Joke Database';

        return ['template' => 'home.html.php', 'title' => $title];
    }
}