<?php include "fragment/head.php"; ?>
<body>

<div id="wrapper">
    <?php
        include "fragment/header.php";
        require_once dirname(__FILE__) . '\..\util.php';
    ?>

    <form name="message" action="../controller/sendMessageController.php" method="post">
        To: <input type="text" name="message_to"><br/><br/>
        Title: <input type="text" name="message_title"><br/><br/>
        Message: <br/>
        <textarea rows="10" cols="60" name="message_content"></textarea>
        <?php
            echo '<input type="hidden" name="message_from" value="' . $user . '"/><br/>';
        ?>
        <input class="button2" type="submit" value="Submit">
    </form>

</div>
</body>
