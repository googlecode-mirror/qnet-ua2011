<?php

require_controller("sessionController");
use Qnet\Controller\SessionController;

function check_session() {
    $session = new SessionController();
    if (!$session->isLoggedIn()) {
        header("Location: /Qnet/target/classes/php/qnet/ui/login.php?expired=true");
    }
}

function check_logged(){
       $session = new SessionController();
    if ($session->isLoggedIn()) {
        header("Location: /Qnet/target/classes/php/qnet/ui/viewprofile.php");
    }

}


function require_dao($name) {
    use_prefix('dao', $name);
}

function require_controller($name) {
    use_prefix('controller', $name);
}

function require_model($name) {
    use_prefix('model', $name);
}

function require_db() {
    use_prefix('dao', 'db');
}

function require_util($name) {
    use_prefix('util', $name);
}

function use_prefix($file, $name) {
    require_abs("$file\\$name.php");
}

function require_abs($path) {
    require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . $path;
}

?>