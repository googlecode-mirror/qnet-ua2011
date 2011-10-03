<?php
namespace Qnet\Dao;

require_once dirname(__FILE__) . '\..\util.php';
require_db();

class messageDAO
{
    public function getMessages($uId)
    {
        $connector = new DBConnector();
        $connection = $connector->createConnection();

        $result = mysql_query("SELECT * FROM messages WHERE to_user='$uId' ORDER BY message_id DESC") or die(mysql_error());

        $ans = array();
        $index=0;
        while($row = mysql_fetch_assoc($result)) {
            $tempResult=array();
            $tempResult["id"] = $row["message_id"];;
            $tempResult["title"]=$row["message_title"];
            $tempResult["read"]=$row["message_read"];
            $ans[$index]=$tempResult;
            $index++;
        }

        mysql_free_result($result);
        mysql_close($connection);
        return $ans;
    }

    public function sendMessage($uid, $toUid, $title, $msg) {
        $connector = new DBConnector();
        $connection = $connector->createConnection();

        mysql_query("INSERT INTO messages (from_user, to_user, message_title, message_contents) VALUES ('$uid','$toUid','$title','$msg')") OR die("Could not send the message: <br>" . mysql_error());
        $mid = mysql_insert_id();
        mysql_close($connection);
        return $mid;
    }

    public function markAsRead($mid) {
        $connector = new DBConnector();
        $connection = $connector->createConnection();
        mysql_query("UPDATE messages SET message_read = 1 WHERE message_id = '$mid'");

        mysql_close($connection);
    }

    public function getMessage($mid) {
        $connector = new DBConnector();
        $connection = $connector->createConnection();
        $result = mysql_query("SELECT * FROM messages WHERE message_id = '$mid'");
        $message = mysql_fetch_array($result);
        $ans = array();
        $ans['title'] = $message['message_title'];
        $ans['from'] = $message ['from_user'];
        $ans['content'] = $message ['message_contents'];
        mysql_free_result($result);
        mysql_close($connection);
        return $ans;
    }
}