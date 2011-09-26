<?php

namespace Qnet\Controller;


    require_once dirname(__FILE__) . '\..\util.php';
    require_dao('userDAO');
    require_controller("logoutController");
    use Qnet\Dao\UserDAO;
    use Qnet\Controller\LogoutController;

    $c = new LogoutController();
    $udao = new UserDAO();
    $udao->deleteUser(getUID());
    $uid = $c->logout();

    header("Location: /Qnet/target/classes/php/qnet/ui/login.php");

?>