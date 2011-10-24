<?php include "fragment/head.php"; ?>
<body>

<div id="wrapper">
    <?php include "fragment/header.php"; ?>
    <?php
        require_once dirname(__FILE__) . '\..\util.php';
    require_controller('inboxController');
    use Qnet\Controller\InboxController;
    $controller = new InboxController();

    // display each message title, with a link to their content
    echo '<ul>';
    while ($controller->hasMoreMessages())
    {
        $controller->nextMessage();
        echo '<a href="read_message.php?messageid=' . $controller->getMid() . '">' . $controller->getTitle() . '</a>';
        if (!$controller->isRead()) {
            echo '(New)';
        }
        echo '<br/>';
    }
    echo '</ul>';

    ?>

    <form name="newmsgfrm" method="post" action="new_message.php">
        <input class="button" type="submit" value="Send a New Message"/>
    </form>

</div>
</body>

