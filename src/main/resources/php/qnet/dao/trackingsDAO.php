<?php

namespace Qnet\Dao;
require_once dirname(__FILE__) . '\..\util.php';
require_db();

class TrackingsDAO
{

    public function approvalRequested($followedId, $followerId)
    {
        $connector = new DBConnector();
        $connection = $connector->createConnection();
        $date = date('Y-m-d H:i:s');
        $query = "INSERT INTO trackings (followedId, followerId, approved, date) VALUES ($followedId,$followerId,0, '$date');";
        mysql_query($query) or die ("Error in query: $query. " . mysql_error());
        mysql_close($connection);
    }

    public function unfollowUser($followedId, $followerId)
    {
        $connector = new DBConnector();
        $connection = $connector->createConnection();
        $query = "DELETE FROM trackings WHERE followerId=$followerId AND followedId=$followedId";
        mysql_query($query) or die ("Error in query: $query. " . mysql_error());
        mysql_close($connection);
    }

    public function getFollowers($userId)
    {
        $connector = new DBConnector();
        $connection = $connector->createConnection();
        $result = mysql_query("SELECT t.followerId AS uid, u.name AS name, u.lastname AS lastname FROM trackings t JOIN users u WHERE u.id=t.followerId AND t.approved=1 AND followedId='$userId'") or die ("Error");
        $ans = array();
        while ($row = mysql_fetch_assoc($result)) {
            $ans[$row['uid']] = $row['name'] . " " . $row['lastname'];
        }
        mysql_free_result($result);
        mysql_close($connection);

        return $ans;
    }

    public function getRanking()
    {
        $connector = new DBConnector();
        $connection = $connector->createConnection();
        $result = mysql_query("select followedId, count(followerId) as quantity ,u.name,u.lastname from trackings t join users u on t.followedId=u.id  group by followedId order by count(followerId) desc limit 20");
        $ans = array();
        $index = -1;
        while ($row = mysql_fetch_assoc($result)) {
            $index++;
            $tempResult = array();
            $tempResult["name"] = $row["name"];
            $tempResult["lastname"] = $row["lastname"];
            $tempResult["quantity"] = $row["quantity"];


            $ans[$index] = $tempResult;
        }
        mysql_free_result($result);
        mysql_close($connection);

        return $ans;
    }

    function insertTracking($followingId, $followerId, $approved, $date)
    {
        $connector = new DBConnector();
        $connection = $connector->createConnection();
        $track = "INSERT INTO trackings (followedId, followerId,approved, date) VALUES ($followingId,$followerId," . ($approved
                ? 1 : 0) . ", '$date');";
        mysql_query($track) or die ("Error in query: $track. " . mysql_error());
        mysql_close($connection);
    }

    public function getFollowed($userId)
    {
        $connector = new DBConnector();
        $connection = $connector->createConnection();
        $result = mysql_query("SELECT t.followedId AS uid, u.name AS name, u.lastname AS lastname FROM trackings t JOIN users u WHERE u.id=t.followedId AND t.approved=1 AND followerId='$userId'") or die ("Error");
        $ans = array();
        while ($row = mysql_fetch_assoc($result)) {
            $ans[$row['uid']] = $row['name'] . " " . $row['lastname'];
        }
        mysql_free_result($result);
        mysql_close($connection);

        return $ans;
    }

    public function notificationReceived($id)
    {
        $connector = new DBConnector();
        $connection = $connector->createConnection();
        $date = date('Y-m-d H:i:s');
        $query = 'UPDATE trackings SET notified=1, date="' . $date . '" WHERE id=' . $id;
        mysql_query($query) or die ("Error in query: $query. " . mysql_error());
        mysql_close($connection);
    }

    public function approvalAccepted($id)
    {
        $connector = new DBConnector();
        $connection = $connector->createConnection();
        $date = date('Y-m-d H:i:s');
        $query = 'UPDATE trackings SET approved=1, date="' . $date . '" WHERE id=' . $id;
        mysql_query($query) or die ("Error in query: $query. " . mysql_error());
        mysql_close($connection);
    }

    public function getTrackingById($trackingId)
    {
        $connector = new DBConnector();
        $connection = $connector->createConnection();

        $query = 'SELECT followedId, followerId FROM trackings WHERE id=' . $trackingId;
        $result = mysql_query($query) or die ("Error");
        while ($row = mysql_fetch_assoc($result)) {
            $ans = array($row['followedId'], $row['followerId']);
        }

        mysql_free_result($result);
        mysql_close($connection);

        return $ans;
    }

    public function getNotificationsByUserId($user)
    {
        $connector = new DBConnector();
        $connection = $connector->createConnection();

        $query = "(SELECT id, followedId AS uid, approved, date FROM trackings WHERE approved=1 AND notified=0 AND followerId=$user) UNION (SELECT id, followerId AS uid, approved, date FROM trackings WHERE approved=0 AND notified=0 AND followedId=$user) ORDER BY date DESC";

        $result = mysql_query($query) or die ("Error in " . $query);
        $ans = array();
        while ($row = mysql_fetch_assoc($result)) {
            $ans[$row['id']] = array($row['uid'], $row['approved'], $row['date']);
        }

        mysql_free_result($result);
        mysql_close($connection);

        return $ans;
    }

    public function userFollows($follower, $followed)
    {
        $connector = new DBConnector();
        $connection = $connector->createConnection();

        $query = "SELECT * FROM trackings WHERE followerId=$follower AND followedId=$followed";
        $result = mysql_query($query) or die ("Error");
        $ans = mysql_num_rows($result) != 0;
        mysql_free_result($result);
        mysql_close($connection);

        return $ans;
    }

    public function newTracking($follower, $followed)
    {
        $connector = new DBConnector();
        $connection = $connector->createConnection();

        $date = date('Y-m-d H:i:s');
        $query = "INSERT INTO trackings (followedId, followerId, approved, notified, date) VALUES ($followed, $follower, 0, 0, '$date')";
        mysql_query($query) or die ("Error");
        $tid = mysql_insert_id();
        mysql_close($connection);
        return $tid;
    }

}
