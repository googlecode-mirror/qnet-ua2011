<?php

namespace Qnet\Controller;

require_once dirname(__FILE__) . '\..\util.php';
require_dao('messageDAO');
require_dao('userDAO');
use Qnet\Dao\MessageDAO;
use Qnet\Dao\UserDAO;

$mdao = new MessageDAO();
$udao= new UserDAO();

$toUid = $udao->getUserIdByLastName($_POST['message_to']);
$fromUid = $_POST['message_from'];


if ($toUid<0 || empty($_POST['message_title'])){


    $_SESSION['message_content']= $_POST['message_content'];
    header("Location: /Qnet/target/classes/php/qnet/ui/new_message.php?errors=true");

}else {
    $mdao->sendMessage($fromUid, $toUid, $_POST['message_title'], $_POST['message_content']);

    header("Location: /Qnet/target/classes/php/qnet/ui/inbox.php");
}


/*if (mysql_num_rows(mysql_query($ck_reciever)) == 0) {
    die("The user you are trying to contact don't excist. Please go back and try again.<br>
<form name=\"back\" action=\"new_message.php\"
method=\"post\">
<input type=\"submit\" value=\"Try Again\">
</form>
");
}
elseif (strlen($content) < 1) {
    die("Your can't send an empty message!<br>
<form name=\"back\" action=\"new_message.php\"
method=\"post\">
<input type=\"submit\" value=\"Try Again\">
</form>
");
}
elseif (strlen($title) < 1) {
    die("You must have a Title!<br>
<form name=\"back\" action=\"new_message.php\"
method=\"post\">
<input type=\"submit\" value=\"Try Again\">
</form>
");*/

?>