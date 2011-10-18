<?php

include_once dirname(__FILE__) . '\..\util.php';
require_service("validator");
require_controller("loginController");
require_dao('userDAO');
require_model('User');
use Qnet\Service\Validator;
use Qnet\Dao\UserDAO;
use Qnet\Model\User;
use Qnet\Controller\LoginController;

//check_logged();
session_start();

$c = new LoginController();
$dao = new UserDAO();
$validator = new Validator();

$fieldErrors = $validator->validate();
$validateCaptcha = $validator->validateCaptcha();
if($dao->getUserIdByMail($_POST['mail'] != -1)){
    array_push($fieldErrors, "mail:Mail Already Exits");
}


if ($validateCaptcha && empty($fieldErrors)) {

    $user = new User($_POST['userName'], $_POST['userLastName'], $_POST['mail'], $_POST['password'], $_POST['day'] . '-' . $_POST['month'] . '-' . $_POST['year'], null, null, null, $_POST['institutionName'], null, null);
    User::readProperties($user, $_POST);
    $dao->registerUser($user);
    $c->login($_POST['userName'], $_POST['password']);
    cleanSessionAfterLogin();
    header("Location: viewprofile.php");
    //  header("Location: /Qnet/target/classes/php/qnet/ui/viewprofile.php");
} else {

    $_SESSION["completeForm"] = true;
    $_SESSION["userName"] = $_POST["userName"];
    $_SESSION["userLastName"] = $_POST["userLastName"];
    $_SESSION["mail"] = $_POST["mail"];
    $_SESSION["day"] = $_POST["day"];
    $_SESSION["month"] = $_POST["month"];
    $_SESSION["year"] = $_POST['year'];
    $_SESSION["institutionName"] = $_POST['institutionName'];

    $_SESSION[User::$GENDER] = $_POST[User::$GENDER];
    $_SESSION[User::$MARITAL_STATUS] = $_POST[User::$MARITAL_STATUS];
    $_SESSION[User::$STUDIES] = $_POST[User::$STUDIES];
    $_SESSION[User::$LOCATION] = $_POST[User::$LOCATION];
    $_SESSION[User::$RELIGION] = $_POST[User::$RELIGION];


    if (!$validateCaptcha) {
        array_push($fieldErrors, "captcha:Wrong Captcha");
    }
    $_SESSION["errors"] = $fieldErrors;

    header("Location: signup.php?error=true");
    // header("Location: /Qnet/target/classes/php/qnet/ui/signup.php?error=true");
}
?>