

<?php

include_once  ("../external/mailer/swift_required.php");
include_once  ("../util/MailSender.php");

/*
    $transport = Swift_SmtpTransport::newInstance('smtp.gmail.com')
      ->setPort(465)
      ->setEncryption('ssl')
      ->setUsername('qnetaustral@gmail.com')
      ->setPassword('qnetpass')
      ;

    $mailer = Swift_Mailer::newInstance($transport);

    $message = Swift_Message::newInstance('Test')
      ->setFrom(array('damianminniti@gmail.com' => 'From mr. 007'))
      ->setTo(array('damianminniti@gmail.com', 'damianminniti@gmail.com' => 'To mr. 007'))
      ->setBody('Body')
      ;

    $result = $mailer->send($message);
  */

      $mailSender=new MailSender();
      $mailSender->sendMail("qnet","qnetaustral@gmail.com","Content","subject");

?>