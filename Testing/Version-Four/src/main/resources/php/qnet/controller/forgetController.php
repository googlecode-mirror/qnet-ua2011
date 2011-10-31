<?php
namespace Qnet\Controller;
require_once dirname(__FILE__) . '\..\util.php';

require_dao('userDAO');
require_model('User');
require_controller("sessionController");
require_service("mailer/swift_required");
require_service("MailSender");
use Qnet\Service\MailSender;
use Qnet\Dao\UserDAO;
use Qnet\Model\User;
use Qnet\Controller\SessionController;



class ForgetController
{

    function recover($mail)
    {
        $dao = new UserDAO();
        $id = $dao->getUserIdByMail($mail);
        if ($id != -1) {
            $user = $dao->selectUserById($id);
            $name = $user->getName();
            $pass = $user->getPassword();
            $message = "Dear " . $name . ", Your account password is " . $pass;
            $subject = "Password Recovery Mail";
            $mailSender = new MailSender();
            $mailSender->sendMail("passwordRecover@qnet.com",$mail, $message, $subject);
        }
        return $id;
    }
}

?>
