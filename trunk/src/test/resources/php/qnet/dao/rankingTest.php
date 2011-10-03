<?php

require_once dirname(__FILE__) . '\..\util.php';
require_db();
require_dao('TrackingsDAO');
require_dao('UserDAO');
require_model('User');
use Qnet\Dao\TrackingsDAO;
use Qnet\Model\User;
use Qnet\Dao\UserDAO;
function getNextDate($phpdate)
{
    $phpdate->add(new DateInterval("PT6H15M"));
    return date('Y-m-d H:i:s', $phpdate->getTimestamp());
}

$phpdate = date_create("last Wednesday");
$trackingDAO = new TrackingsDAO();
$userDAO = new UserDAO();
$trackingDAO->insertTracking(9, 2, true, '14-11-1940');
$trackingDAO->insertTracking(9, 3, true, '14-11-1940');
$trackingDAO->insertTracking(9, 4, true, '14-11-1940');
$trackingDAO->insertTracking(9, 5, true, '14-11-1940');
$trackingDAO->insertTracking(9, 6, true, '14-11-1940');

$results = $trackingDAO->getRanking();
$value = $results[0];
$name = $value["name"];
$lastname = $value["lastname"];
$quantity = $value["quantity"];
$correctname=$userDAO->selectUserById(9);
$correctname = $correctname->getName();

if($name==$correctname ){


}  else{
    echo ("the name doesn't match");



}




?>