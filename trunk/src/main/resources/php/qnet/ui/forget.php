<?php
    require_once dirname(__FILE__) . '\..\util.php';
require_controller("sessionController");
use Qnet\Controller\SessionController;
$session = new SessionController();
if ($session->isLoggedIn()) {
    header("Location: /Qnet/target/classes/php/qnet/ui/viewprofile.php");
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/html4/loose.dtd">
<html>
</body>


<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

    <title>Qnet Login</title>

    <link rel="shortcut icon" href="/favicon.ico">
    <link rel="stylesheet" type="text/css" href="login.css"/>
</head>

<body>
<form action="forgetFrontend.php" method="post">

    <fieldset>

        <legend>Recover Pass</legend>
        <div class="clear"></div>
        <label for="mail">Put the email that enter when your create your account </label>


        <label for="mail">Email </label>
        <input type="mail" name="mail" id="mail"/>


        <div class="clear"></div>

        <br/>

        <input type="submit" style="margin: -20px 0 0 287px;" class="button" name="commit" value="Recover"/>
    </fieldset>
<?php
    if ($_GET['error'] == 'true') {
    echo '<br></label><p>The email that your enter is not on the database!';
}
    ?>
<?php
    if ($_GET['sended'] == 'true') {
    echo '<br></label><p>An email was send with your User and Password.';
}
    ?>

</form>


</body>

</html>