<?php

namespace Qnet\Controller;

    require_once dirname(__FILE__) . '\..\..\util.php';
    require_dao('UserDAO');
    use Qnet\Dao\UserDAO;


    $sc = new SearchUserController();
    $lastNameToSearch = $_POST["ajaxUser"];

    //here the user got the suggestion and wants to go to the others profile;
    $redirect = "Location: /Qnet/target/classes/php/qnet/ui/viewprofile.php";
    if (!empty($lastNameToSearch)) {
        $uid = $sc->searchUser($lastNameToSearch);
        if ($uid != -1) {
            $redirect = "Location: /Qnet/target/classes/php/qnet/ui/viewprofile.php?uid=$uid";
        }
    }

    header($redirect);

    class SearchUserController {

        public function searchUser($userLastName) {
            $dao = new UserDAO();
            $userId = $dao->getUserIdByLastName($userLastName);
            return $userId;
        }

        public function getPartialResults($partialName) {
            $dao = new UserDAO();
            $users = $dao->getUsersByPartialString($partialName);
            return $users;
        }

    }
?>
