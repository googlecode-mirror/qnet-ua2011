<?php
namespace Qnet\Dao;

    require_once dirname(__FILE__) . '\..\util.php';
	require_dao('userDAO');
    use Qnet\Dao\UserDAO;
    require_db();

    class CommentDAO {

        public function saveComment($qId, $uId, $text) {
            $connector = new DBConnector();
            $connection = $connector->createConnection();
            $date = date('Y-m-d H:i:s');
            $query = "INSERT INTO comment (text,FK_userId,FK_queryId, date) VALUES ('$text','$uId','$qId', '$date')";
            mysql_query($query) or die("Error in query: $query. " . mysql_error());
            mysql_close($connection);
        }


        public function loadAllComments($qId) {
            $connector = new DBConnector();
            $connection = $connector->createConnection();
            $result = mysql_query("SELECT * FROM comment WHERE FK_queryId='$qId' ORDER BY date") or die ("Error"); //TODO DATE
            $titles = array();
            $dates = array();
            $names = array();

            $udao = new UserDAO();

            while($row = mysql_fetch_assoc($result)) {
                $titles[$row['id']] = $row['text'];
                $dates[$row['id']] = $row['date'];
                $uid = $row['FK_userId'];
                $names[$row['id']] = $udao->selectUserNameById($uid);
            }
            mysql_free_result($result);
            mysql_close($connection);

            return array($titles, $dates, $names);
        }
    }

    ?>