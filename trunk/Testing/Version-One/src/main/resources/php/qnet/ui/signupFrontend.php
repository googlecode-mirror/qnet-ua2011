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

if (empty($fieldErrors) && $validateCaptcha) {

    $user = new User($_POST['userName'], $_POST['userLastName'], $_POST['password'], $_POST['day'] . '-' . $_POST['month'] . '-' . $_POST['year'], null, null, null, $_POST['institutionName'], null, null);
    User::readProperties($user, $_POST);
    $dao->registerUser($user);
    $c->login($_POST['userName'], $_POST['password']);
    cleanSessionAfterLogin();
    header("Location: viewprofile.php");
  //  header("Location: /Qnet/target/classes/php/qnet/ui/viewprofile.php");
} else {

    $_SESSION["completeForm"]=true;
    $_SESSION["userName"]=$_POST["userName"];
    $_SESSION["userLastName"]=$_POST["userLastName"];
    $_SESSION["day"]=$_POST["day"];
    $_SESSION["institutionName"]=$_POST['institutionName'];
    $_SESSION["errors"]=$fieldErrors;

    header("Location: signup.php?error=true");
   // header("Location: /Qnet/target/classes/php/qnet/ui/signup.php?error=true");
}
?>