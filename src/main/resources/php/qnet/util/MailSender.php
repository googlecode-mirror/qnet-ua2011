<?php
/**
 * Created by IntelliJ IDEA.
 * User: Pablo
 * Date: 10/17/11
 * Time: 8:59 PM
 * To change this template use File | Settings | File Templates.
 */

class MailSender
{

    private $user;
    private $password;
    private $transport;
    private $mailer;

    public function __construct()
    {
        $this->transport = Swift_SmtpTransport::newInstance('smtp.gmail.com')
                ->setPort(465)
                ->setEncryption('ssl')
                ->setUsername('qnetaustral@gmail.com')
                ->setPassword('qnetpass');

        $this->mailer = Swift_Mailer::newInstance($this->transport);


    }

    public function sendMail($from, $to, $content, $subject)
    {

        /*
         $message = Swift_Message::newInstance('Test')
                 ->setFrom(array('damianminniti@gmail.com' => 'From mr. 007'))
                 ->setTo(array('damianminniti@gmail.com', 'damianminniti@gmail.com' => 'To mr. 007'))
                 ->setBody('Body');

         $this->mailer->sendmail($message);
        */
        $transport = Swift_SmtpTransport::newInstance('smtp.gmail.com')
                ->setPort(465)
                ->setEncryption('ssl')
                ->setUsername('qnetaustral@gmail.com')
                ->setPassword('qnetpass');

        $mailer = Swift_Mailer::newInstance($transport);

        $message = Swift_Message::newInstance('Test')
                ->setFrom(array('damianminniti@gmail.com' => 'From mr. 007'))
                ->setTo(array('damianminniti@gmail.com', 'damianminniti@gmail.com' => 'To mr. 007'))
                ->setBody('Body');

        $result = $mailer->send($message);

    }


}
