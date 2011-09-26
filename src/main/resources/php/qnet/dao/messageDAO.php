<?php
namespace Qnet\Dao;

require_once dirname(__FILE__) . '\..\util.php';
require_db();

class messageDAO
{
    public function getMessages($uId){
        $connector = new DBConnector();
        $connection = $connector->createConnection();
        $result = mysql_query("SELECT * FROM messages WHERE to_user='$uId' ORDER BY message_id DESC") or die(mysql_error());
        $ans = array();
        while ($row = mysql_fetch_assoc($result)) {
            $ans[$row['id']] = $row['text'];
        }
        mysql_free_result($result);
        mysql_close($connection);

        return $ans;


    }
}