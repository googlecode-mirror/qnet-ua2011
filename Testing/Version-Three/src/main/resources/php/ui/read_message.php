<?php include "fragment/head.php"; ?>
<body>

<div id="wrapper">


    <?php include "fragment/header.php";

    //    require 'database.php';

    require_once dirname(__FILE__) . '\..\util.php';
    require_controller('inboxReadController');
    use Qnet\Controller\InboxReadController;
    $controller = new InboxReadController();

    ?>



    <?php


    echo "<h1>Title: " . $controller->getTitle() . "</h1><br><br>";
    echo "<h3>From: " . $controller->getFrom() . "<br><br></h3>";
    echo "<h3>Message: <br>" . $controller->getContent() . "<br></h3>";

    echo '<form name="backfrm" method="post" action="inbox.php">';
    echo '<input type="submit" value="Back to Inbox">';
    echo '</form>';
    ?>

</div>
</body>