<?php

namespace Qnet\Controller;
require_once dirname(__FILE__) . '\..\util.php';
require_dao('trackingsDAO');
require_dao('userDAO');
use Qnet\Dao\TrackingsDAO;

$followedUID = intval($_GET['followed']);
$followerUID = intval($_GET['follower']);
$uid = getUID();
if($uid == $followedUID || $uid == $followerUID) {
    $tdao = new TrackingsDAO();
    $tdao->unfollowUser($followedUID, $followerUID);
}

header("Location: /Qnet/target/classes/php/qnet/ui/viewprofile.php");

?>