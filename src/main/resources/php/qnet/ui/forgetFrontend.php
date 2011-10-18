<?php
include_once dirname(__FILE__) . '\..\util.php';
require_controller("forgetController");

use Qnet\Controller\ForgetController;
$c = new ForgetController();
$uid = $c->recover($_POST['mail']);
if ($uid != -1) {
    header("Location: /Qnet/target/classes/php/qnet/ui/login.php?sended=true");
} else {
    header("Location: /Qnet/target/classes/php/qnet/ui/forget.php?error=true");
}

?>