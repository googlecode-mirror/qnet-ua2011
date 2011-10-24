<?php

namespace Qnet\Controller;
require_once dirname(__FILE__) . '\..\util.php';

require_service("mailer/swift_required");
require_service("MailSender");
use Qnet\Service\MailSender;

       $subject = "Join Qnet!";
       $content = "Sent you an invitation to join Qnet, the best Query networking site! http://localhost/Qnet/target/classes/php/qnet";
       $to = $_POST['friend_mail'];


      $mailSender=new MailSender();
      $mailSender->sendMail("recommend@qnet.com",$to,$content,$subject);

    header("Location: /Qnet/target/classes/php/qnet/ui/viewprofile.php?recommend=ok");


?>