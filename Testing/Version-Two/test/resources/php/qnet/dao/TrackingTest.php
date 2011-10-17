<?php

require_once dirname(__FILE__) . '\..\util.php';
require_db();
require_dao('TrackingsDAO');
require_model('User');
use Qnet\Dao\TrackingsDAO;
use Qnet\Model\User;

		$trackingDAO = new TrackingsDAO();
		$trackingDAO->unfollowUser(1,2);
		$results =$trackingDAO->getFollowed(2);  //a QUIEN SIGUE 2
		if(array_search("1",$results)!=null){
			echo "User 2 is still followed by User 1" ;
		}

		$followersOf1 = $trackingDAO->getFollowers(1);      //Los seguidores de 1
          if(array_search("2",$results)!=null){
			 echo "User 2 is still followed by User 1" ;
			}

















                     /*


	public function getFollowers($userId){
        $connector = new DBConnector();
        $connection = $connector->createConnection();
        $result = mysql_query("SELECT t.followerId AS uid, u.name AS name FROM trackings t JOIN users u WHERE u.id=t.followerId AND t.approved=1 AND followedId='$userId'") or die ("Error");
        $ans = array();
        while($row = mysql_fetch_assoc($result)) {
            $ans[$row['uid']] = $row['name'];
        }
        mysql_free_result($result);
        mysql_close($connection);

        return $ans;
	}

	public function getFollowed($userId){
        $connector = new DBConnector();
        $connection = $connector->createConnection();
        $result = mysql_query("SELECT t.followedId AS uid, u.name AS name FROM trackings t JOIN users u WHERE u.id=t.followedId AND t.approved=1 AND followerId='$userId'") or die ("Error");
        $ans = array();
        while($row = mysql_fetch_assoc($result)) {
            $ans[$row['uid']] = $row['name'];
        }
        mysql_free_result($result);
        mysql_close($connection);

        return $ans;
	}

*/


?>