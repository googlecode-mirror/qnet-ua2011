<?php include "fragment/head.php"; ?>
<body>

<div id="wrapper">


    <?php include "fragment/header.php";

    //    require 'database.php';

    require_once dirname(__FILE__) . '\..\util.php';
    require_controller('inboxReadController');
    use Qnet\Controller\InboxReadController;
    $controller = new InboxReadController();


    $title =  $controller->getTitle();
    $from = $controller->getFrom();
    $content =  $controller->getContent();



    ?>



    <form action="bridge.php?target=replyController" method="POST">

        <label> Title: </label> <br/>
        <input type="text" value="<?php echo $title;?>" name="title" id="title" readonly="true">  <br/>
        <label> From: </label>    <br/>

        <input type="text" value="<?php echo $from;?>" name="from" id="from" readonly="true">    <br/>

        <label> Message: </label>               <br/>
        <textarea rows="5" cols="40" name="content" readonly="true"> <?php echo $content;?> </textarea> <br/>
<!--        <input type="textArea" cols="60" rows = "10" value="--><?php //echo $content;?><!--" name="content" disabled="true"> <br/>-->
        <input type="submit" value="Reply">


    </form>
    <a href="inbox.php">Back to Inbox</a>


<!--    echo "<h1>Title: " . $controller->getTitle() . "</h1><br><br>";-->
<!--    echo "<h3>From: " . $controller->getFrom() . "<br><br></h3>";-->
<!--    echo "<h3>Message: <br>" . $controller->getContent() . "<br></h3>";-->
<!---->
<!--    echo '<form name="backfrm" method="post" action="inbox.php">';-->
<!--    echo '<input type="submit" value="Back to Inbox">';-->
<!--    echo '</form>';-->
<!--    echo '<input type="button" value="Reply" action="new_message.php?reply=true"> '-->
<!---->


</div>
</body>