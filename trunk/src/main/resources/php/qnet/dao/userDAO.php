<?php

namespace Qnet\Dao;
require_once dirname(__FILE__) . '\..\util.php';
require_db();
require_model('User');
use Qnet\Model\User;

class UserDAO {

	public function selectUserNameById($uid) {
	    $connector = new DBConnector();
	    $connection = $connector->createConnection();

	    $query = 'SELECT name, lastname FROM users u WHERE u.alive=1 AND u.id='.$uid;
	    $result = mysql_query($query) or die ("Error in query: $query. " . mysql_error());
	    if(!$result || mysql_num_rows($result) == 0) {
	        return false;
	    }
	    $data = mysql_fetch_assoc($result);
	    $name = $data['name'];
	    $lastname = $data['lastname'];
	    mysql_free_result($result);
	    mysql_close($connection);

		return $name. ' '.$lastname;
	}


    public function selectUserById($userId) {
        $connector = new DBConnector();
        $connection = $connector->createConnection();

        $query = 'SELECT name, lastname, password, alive FROM users u WHERE u.alive=1 AND u.id='.$userId;
        $result = mysql_query($query) or die ("Error in query: $query. " . mysql_error());
        if(!$result || mysql_num_rows($result) == 0) {
            return false;
        }
        $data = mysql_fetch_assoc($result);
        $name = $data['name'];
        $lastname = $data['lastname'];
        $password = $data['password'];
        $alive = $data['alive']; 
        mysql_free_result($result);
		$id=intval($userId);
        $query = 'SELECT * FROM userinfo u WHERE u.FK_users='.$userId;
        $result = mysql_query($query) or die ("Error in query: $query. " . mysql_error());
        $data = mysql_fetch_row($result);
        $user = new User($name,$lastname,$password,$data[2],$data[3],$data[4],$data[5],$data[6],$data[7],$data[8],$data[9],$alive);
        $user->setId($id);
        mysql_free_result($result);
        mysql_close($connection);

	    return $user;
    }

    public function registerUser($user) {
        $connector = new DBConnector();
        $connection = $connector->createConnection();

        $query = "INSERT INTO users (name,lastName,password,alive) VALUE ('$user->name','$user->lastName','$user->password', $user->alive);";
        mysql_query($query) or die ("Error in query: $query. " . mysql_error());
        $uid = mysql_insert_id();

        $query = "INSERT INTO userinfo (FK_users, dateOfBirth, gender, maritalSt, studies, InstitutionName, currentLocation, religion, photo)
VALUE ($uid, '$user->birth','$user->gender','$user->maritalSt','$user->studies','$user->InstitutionName','$user->country','$user->religion', '$user->photo');";
        mysql_query($query) or die ("Error in query: $query. " . mysql_error());

        mysql_close($connection);
        return $uid;
    }

	public function getUserIdByUserAndPass($name , $pass){
        $connector = new DBConnector();
        $connection = $connector->createConnection();

        $query = 'SELECT id FROM users u WHERE u.name="'.$name.'" AND u.password="'.$pass.'" AND u.alive=1';

        $result = mysql_query($query) or die ("Error in query: $query. " . mysql_error());

        if(mysql_num_rows($result) == 0){
            return -1;
        }

        $row = mysql_fetch_row($result);
        $uid = $row[0];
        mysql_free_result($result);
        mysql_close($connection);
        return $uid;
	}

	public function getUserIdByLastName($userLastName){
		$connector = new DBConnector();
        $connection = $connector->createConnection();
		$userName = strtok($userLastName, " ");
		$userLastName = strtok(" ");
		$query = "SELECT * FROM users u WHERE u.alive=1 AND u.name='" . $userName .  "' AND u.lastname='" . $userLastName . "'";
		$result = mysql_query($query) or die ("Error in query: $query. " . mysql_error());
		if(!$result || mysql_num_rows($result) == 0){
			return -1;
		}
		$row = mysql_fetch_row($result);
        mysql_free_result($result);
		mysql_close($connection);
		return $row[0];
	}

	public function updateUser($user, $uid){
		$connector = new DBConnector();
        $connection = $connector->createConnection();
		$query = "UPDATE users set name='".$user->getName()."', lastname='".$user->getLastName()."', password='".$user->getPassword()."' where id=".$uid;
        mysql_query($query) or die ("Error in query: $query. " . mysql_error());
		mysql_close($connection);
	}

    public function deleteUser($id){
        $connector = new DBConnector();
        $connection = $connector->createConnection();
        $query = 'UPDATE users set alive=0 where id='.$id;
        mysql_query($query) or die ("Error in query: $query. " . mysql_error());
        mysql_close($connection);
    }
    
	public function getUsersByPartialString($partialName){
		$connector = new DBConnector();
        $connection = $connector->createConnection();

		$query = 'SELECT name,lastname FROM users u WHERE u.alive=1 AND u.name LIKE "' .$partialName .'%"';
		$result = mysql_query($query);
		if(mysql_num_rows($result) == 0){
			return -1;
		}
		$answer = array();
		$i = 0;
		while ($row = mysql_fetch_row($result)) {
		    $answer[$i] = $row[0] . " " . $row[1];
			$i++;
		}
		mysql_free_result($result);
		mysql_close($connection);

		return $answer;
	}

}

?>