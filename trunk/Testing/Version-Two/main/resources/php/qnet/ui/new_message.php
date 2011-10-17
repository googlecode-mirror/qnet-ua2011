<?php include "fragment/head.php"; ?>
<body>

<div id="wrapper">
    <?php
        include "fragment/header.php";
    require_once dirname(__FILE__) . '\..\util.php';

    $user = $_SESSION['uid'];
    ?>

    <link rel="stylesheet" type="text/css" href="qnet.css"/>
    <link rel="stylesheet" type="text/css" href="autocomplete.css"/>
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="qnet.js"></script>
    <script type="text/javascript" src="autocomplete.js"></script>
    <script type="text/javascript">
        $(function() {
            $("#searchUser1").autocomplete("bridge.php?target=search/userSuggestionController", {autoFill: true});
        });
    </script>

    <form name="message" action="../controller/sendMessageController.php" method="post">

        To: <input type="text" name="message_to" id="searchUser1"><br/><br/>
        Title: <input type="text" name="message_title"><br/><br/>
        <input name="message_from" type="text" value="<?php echo $user;?>" hidden="true">
        Message: <br/>
        <textarea rows="10" cols="60" name="message_content"> </textarea>
        <input class="button2" type="submit" value="Submit">
    </form>

</div>
</body>
