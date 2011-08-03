<?php

    require_once dirname(__FILE__) . '\..\util.php';
    require_model("User");
    use Qnet\Model\User;

    $category = $_GET["category"];
    User::printSimpleOptionsFor($category);

?>