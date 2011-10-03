<?php

namespace Qnet\Controller;

require_once dirname(__FILE__) . '\..\util.php';
require_dao('messageDAO');
use Qnet\Dao\MessageDAO;

$dao = new MessageDAO();
$dao->sendMessage(getUID(), $_POST['message_to'], $_POST['message_title'], $_POST['message_content']);

header("Location: /Qnet/target/classes/php/qnet/ui/inbox.php");
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