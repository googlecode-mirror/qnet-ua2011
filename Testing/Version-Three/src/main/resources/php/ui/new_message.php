<?php include "fragment/head.php"; ?>
<body>

<div id="wrapper">
    <?php
        include "fragment/header.php";
    require_once dirname(__FILE__) . '\..\util.php';

    $user = $_SESSION['uid'];

    $emptyValue = "";
    $defaultMessageTo = $emptyValue;
    $defaultMessageTitle = $emptyValue;
    $defaultMessageContent = $emptyValue;

    function startsWithTag($haystack, $needle)
    {
        $needle = $needle.":";
        $length = strlen($needle);
        return (substr($haystack, 0, $length) === $needle);
    }

    function removeTag($message, $tag)
    {
        $tag = $tag.":";
        $length = strlen($tag);
        return substr($message, $length);
    }

    function field_errors($field) {

        foreach (array_values($_SESSION["errors"]) as $message){
            if(startsWithTag($message, $field)) {
                echo "<div style='color:red'>- ".removeTag($message, $field)."</div>";
            }
        }
    }

    if(!$_GET['errors']) {
        $_SESSION["errors"] = array();
    } else {
        $defaultMessageTitle = $_SESSION['message_title'];
        $defaultMessageContent = $_SESSION['message_content'];
        $defaultMessageTo = $_SESSION['message_to'];
    }

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

    <form name="message" action="bridge.php?target=sendMessageController" method="post">

        To: <input type="text" name="message_to" id="searchUser1" value="<?php echo $defaultMessageTo;?>"><br/>
        <?php echo field_errors("message_to")?><br/>
        Title: <input type="text" name="message_title" value="<?php echo $defaultMessageTitle;?>"><br/>
        <?php echo field_errors("message_title")?><br/>
        <input name="message_from" type="text" value="<?php echo $user;?>" hidden="true">
        Message: <br/>
        <textarea rows="10" cols="60" name="message_content"> <?php echo $defaultMessageContent;?> </textarea>
        <input class="button2" type="submit" value="Submit">
    </form>

</div>
</body>
