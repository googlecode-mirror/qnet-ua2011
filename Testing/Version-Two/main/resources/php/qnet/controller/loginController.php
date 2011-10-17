<?php

    namespace Qnet\Controller;

    require_once dirname(__FILE__) . '\..\util.php';
    require_dao('userDAO');
    require_model('User');
    require_controller("sessionController");
    use Qnet\Dao\UserDAO;
    use Qnet\Model\User;
    use Qnet\Controller\SessionController;

    class LoginController {

        function login($user, $pass) {
            $s = new SessionController();
            $dao = new UserDAO();
            $id = $dao->getUserIdByUserAndPass($user, $pass);
            if ($id != -1) {
                $user = $dao->selectUserById($id);
                $s->setUID($id);
                $s->setUsername($user->getName());
            }
            return $id;
        }
    }
?>
