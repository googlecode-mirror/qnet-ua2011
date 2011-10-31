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
<form action="loginFrontend.php" method="post">

    <fieldset>

        <legend>Log in</legend>

        <label for="userName">User </label>
        <input type="text" name="userName" id="userName"/>

        <div class="clear"></div>

        <label for="userPass">Password </label>
        <input type="password" name="userPass" id="userPass"/>

        <div class="clear"></div>

        <label for="remember_me" style="padding: 0;">
            <a href="signup.php"> Sign up</a>
        </label>

        <label for="remember_me" style="padding: 0;">
            <a href="forget.php"> Forget Pass</a>

        </label>


        <div class="clear"></div>

        <br/>

        <input type="submit" style="margin: -20px 0 0 287px;" class="button" name="commit" value="Log In"/>
    </fieldset>
<?php
    if ($_GET['error'] == 'true') {
    echo '<p>Incorrect user and/or password! Try once more!';
}
    ?>
<?php
    if ($_GET['expired'] == 'true') {
    echo '<p>Your session has expired. Please log in again.';
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