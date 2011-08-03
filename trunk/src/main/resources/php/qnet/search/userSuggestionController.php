<?php

namespace Qnet\Controller;
    require_once dirname(__FILE__) . '\..\..\util.php';
    require_dao('UserDAO');
    use Qnet\Dao\UserDAO;

    $ajaxUser = $_GET["q"];

    if ($ajaxUser != null) {
        $udao = new UserDao();
        $usersArray = $udao->getUsersByPartialString($ajaxUser);
        $arraySize = count($usersArray);
        $answer = "";
        foreach (array_values($usersArray) as $username) {
            $answer = $answer . $username . "\n";
        }
        echo $answer;
    }

    ?>