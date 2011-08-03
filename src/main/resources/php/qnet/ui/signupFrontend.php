<?php

include_once dirname(__FILE__) . '\..\util.php';
require_controller("loginController");
require_dao('userDAO');
require_model('User');
use Qnet\Dao\UserDAO;
use Qnet\Model\User;
use Qnet\Controller\LoginController;
$c = new LoginController();
$dao = new UserDAO();

$user = new User($_POST['userName'],$_POST['userLastName'],$_POST['password'],$_POST['day'].'-'.$_POST['month'].'-'.$_POST['year'],null,null,null,$_POST['InstitutionName'],null,null);
User::readProperties($user, $_POST);
$dao->registerUser($user);
$c->login($_POST['userName'], $_POST['password']);

header("Location: /Qnet/target/classes/php/qnet/ui/viewprofile.php");

?>