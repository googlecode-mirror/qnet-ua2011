<?php
session_start();
require "database.php";

$title = $_POST['message_title'];
$to = $_POST['message_to'];
$content = $_POST['message_content'];
$from=$_POST['message_from'];
//$time=$_POST['message_date'];



$ck_reciever = "SELECT name FROM users WHERE name = '" . $to . "'";


if (mysql_num_rows(mysql_query($ck_reciever)) == 0) {
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
");
} else {
    mysql_query("INSERT INTO messages (from_user, to_user, message_title, message_contents) VALUES ('$from','$to','$title','$content')") OR die("Could not send the message: <br>" . mysql_error());
    echo "The Message Was Successfully Sent!";
    ?>
<form name="back" action="inbox.php"
      method="post">
    <input type="submit" value="Back to The Inbox">
</form>
<?php

}
?>