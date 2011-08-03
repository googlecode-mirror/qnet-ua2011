<?php

include_once dirname(__FILE__) . '\..\util.php';
require_controller("loginController");
use Qnet\Controller\LoginController;
$c = new LoginController();
$uid = $c->login($_POST['userName'], $_POST['userPass']);
if ($uid != -1) {
    header("Location: /Qnet/target/classes/php/qnet/ui/viewprofile.php");
} else {
    header("Location: /Qnet/target/classes/php/qnet/ui/login.php?error=true");
}

?>