<?php

    require_once dirname(__FILE__) . '\..\util.php';
    check_session();
    require_controller("headerController");
    use Qnet\Controller\HeaderController;
    $header = new HeaderController();

    $ui = $_GET['target'];

    include "fragment/follow$ui.php";

?>