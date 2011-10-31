<?php

namespace Qnet\Controller;
require_once dirname(__FILE__) . '\..\util.php';


    $_SESSION['message_to']=$_POST['from'];
    $_SESSION['message_title']=$_POST['title'];
    $_SESSION['message_content']=$_POST['content'];

//print_r($_SESSION);

    /*print_r($_SESSION);*/
    header("Location: /Qnet/target/classes/php/qnet/ui/new_message.php?reply=true");
    /*header("mock.php")*/


?>