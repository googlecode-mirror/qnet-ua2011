<?php
namespace Qnet\Dao;

require_once dirname(__FILE__) . '\..\util.php';
require_db();

class CommentDAO
{

    public function saveComment($qId, $uId, $text)
    {
        $connector = new DBConnector();
        $connection = $connector->createConnection();
        $date = date('Y-m-d H:i:s');
        $query = "INSERT INTO comment (text,FK_userId,FK_queryId, date) VALUES ('$text','$uId','$qId', '$date')";
        mysql_query($query) or die("Error in query: $query. " . mysql_error());
        $lastId = mysql_insert_id();
        mysql_close($connection);
        return $lastId;
    }


    public function loadAllComments($qId)
    {
        $connector = new DBConnector();
        $connection = $connector->createConnection();
        $result = mysql_query("SELECT * FROM comment WHERE FK_queryId='$qId'") or die ("Error"); //TODO DATE
        $ans = array();
        while ($row = mysql_fetch_assoc($result)) {
            $ans[$row['id']] = $row['text'];
        }
        mysql_free_result($result);
        mysql_close($connection);

        return $ans;


    }

}

?>