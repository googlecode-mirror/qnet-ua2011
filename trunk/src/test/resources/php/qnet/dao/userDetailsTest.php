<?php

/**
 * Created by IntelliJ IDEA.
 * User: Tomas Alabes
 * Date: 15/09/2010
 * Time: 18:42:45
 * To change this template use File | Settings | File Templates.
 */
require_once dirname(__FILE__) . '\..\util.php';
require_dao('userDao');
use Qnet\Dao\UserDAO;
$userDao = new UserDao();
$uid = 1;
require_model('user');
use Qnet\Model\User;


$lastName = "pepe";
$password = "1234";
$birth = "14-11-1940";
$gender = "Male";
$maritalSt = "Single";
$studies = "University";
$InstitutionName = "UA";
$country = "Argentina";
$religion = "Catholic";
$photo = "img08";
$alive = "1";

$user = new User($name, $lastName, $password, $birth, $gender, $maritalSt, $studies, $InstitutionName, $country, $religion, $photo = 'img08', $alive = 1);

$userDao->registerUser($user);
$userUpdated = $userDao->selectUserById($uid);

if ($userUpdated->birth != $user->birth) {
    echo " Failed birth";
}
if ($userUpdated->country != $user->country) {

    echo " Failed country ";

}
if ($userUpdated->maritalSt != $user->maritalSt) {
    echo " Failed maritalSt ";
}
if ($userUpdated->religion != $user->religion) {
    echo " Failed religion ";
}

if ($userUpdated->gender != $user->gender) {
    echo " Failed gender ";
}
if ($userUpdated->InstitutionName != $user->InstitutionName) {
    echo " Failed InstitutionName ";
}
if ($userUpdated->photo != $user->photo) {
    echo " Failed photo";
}

?>
