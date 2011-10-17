<?php

include_once dirname(__FILE__) . '\..\util.php';
require_controller("logoutController");
use Qnet\Controller\LogoutController;
$c = new LogoutController();
$uid = $c->logout();

header("Location: /Qnet/target/classes/php/qnet/ui/login.php");

?>