<?php
require_once dirname(__FILE__) . '\..\util.php';
require_db();
require_dao('TrackingsDAO');
require_model('User');
use Qnet\Dao\TrackingsDAO;
use Qnet\Model\User;

$trackingDAO = new TrackingsDAO();
$tid = $trackingDAO->newTracking(5, 1);
$notifications = $trackingDAO->getNotificationsByUserId(1);

if ($notifications[$tid] == null) {
    echo "User 1 is not notified new tracking";
}

$trackingDAO->approvalAccepted($tid);

$notifications = $trackingDAO->getNotificationsByUserId(1);
if ($notifications[$tid] != null) {
    echo "User 1 is still notified after accepting";
}

$notifications = $trackingDAO->getNotificationsByUserId(5);
if ($notifications[$tid] == null) {
    echo "User 1 is not notified new tracking";
}

$trackingDAO->notificationReceived($tid);

$notifications = $trackingDAO->getNotificationsByUserId(1);
if ($notifications[$tid] != null) {
    echo "Notification still exists after accepting it";
}

$notifications = $trackingDAO->getNotificationsByUserId(5);
if ($notifications[$tid] != null) {
    echo "Notification still exists after accepting it";
}

$results = $trackingDAO->getFollowed(5); // a quien sigue 1
if ($results[1] == null) {
    echo "User 1 is not following User 5 after Tracking acceptance";
}

$results = $trackingDAO->getFollowers(1);      //Los seguidores de 5
if($results[5] == null){
    echo "User 1 is not a follower of User 5 after Tracking acceptance " ;
}
?>