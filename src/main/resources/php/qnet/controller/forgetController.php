<?php
    namespace Qnet\Controller;
    require_once dirname(__FILE__) . '\..\util.php';

    require_dao('userDAO');
    require_model('User');
    require_controller("sessionController");
    use Qnet\Dao\UserDAO;
    use Qnet\Model\User;
    use Qnet\Controller\SessionController;

    class ForgetController {

        function recover($mail) {
            $dao = new UserDAO();
            $id = $dao->getUserIdByMail($mail);
            if ($id != -1) {
                $user = $dao->selectUserById($id);
                $name = $user->name;
                $pass = $user->password;
                $message = "Dear ".$name.", Your account password is ".$pass;
                $subject = "Password Recovery Mail";
//                $mailSender = new MailSender();
//                $mailSender->sendMail("", "", $message, $subject);
            }
            return $id;
        }
    }
?>
