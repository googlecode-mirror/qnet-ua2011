<?php
    require_once dirname(__FILE__) . '\..\util.php';
    check_session();

    $controller=$_GET['target'];

    require_controller($controller);

?>