<?php include "fragment/head.php"; ?>
<body>

<div id="wrapper">
    <?php include "fragment/header.php";

    require_once dirname(__FILE__) . '\..\util.php';
    require 'database.php';

    $userfinal = $_SESSION['username'];
    ?>



    <?php

    $message_id = $_GET['messageid'];
    mysql_query("UPDATE messages SET message_read = 1 WHERE message_id = '$message_id'");
    $message = mysql_query("SELECT * FROM messages WHERE message_id = '$message_id'");
    $message = mysql_fetch_array($message);

    echo "<h1>Title: " . $message['message_title'] . "</h1><br><br>";
    echo "<h3>From: " . $message['from_user'] . "<br><br></h3>";
    echo "<h3>Message: <br>" . $message['message_contents'] . "<br></h3>";

    echo '<form name="backfrm" method="post" action="inbox.php">';
    echo '<input type="submit" value="Back to Inbox">';
    echo '</form>';
    ?>

</div>
</body>