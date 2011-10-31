<?php
/**
 * Created by IntelliJ IDEA.
 * User: Daniel
 * Date: 28/04/2010
 * Time: 21:48:39
 * To change this template use File | Settings | File Templates.
 */
namespace Qnet\Dao;
require_once dirname(__FILE__) . '\..\util.php';
require_db();

class CreateStatisticsDAO {

    private $connection;
    private $last_statistic_id;

    public function initTransaction() {
        $connector = new DBConnector();
        $this->connection = $connector->createConnection();
    }

    public function endTransaction() {
        mysql_close($this->connection);
    }

    public function persistNewStatistic($title, $uid, $qid) {
	    $date = date('Y-m-d H:i:s');
        $query = "INSERT INTO statistics (title, FK_users, FK_queries, date) VALUES ('$title', $uid, $qid, '$date')";
        mysql_query($query) or die ("Error in query: $query. " . mysql_error());
        $this->last_statistic_id = mysql_insert_id();
        return $this->last_statistic_id;
    }

    public function persistQuestionVariable($qid, $var) {
        return $this->persistQuestionVariableIntoStatistic($this->last_statistic_id, $qid, $var);
    }

    private function persistQuestionVariableIntoStatistic($sid, $qid, $var) {
        $query = "INSERT INTO question_variable (FK_statistics, FK_question, var) VALUES ('$sid', '$qid', '$var')";
        mysql_query($query) or die ("Error in query: $query. " . mysql_error());
        return mysql_insert_id();
    }

    public function persistUserVariable($property, $var) {
        return $this->persistUserVariableIntoStatistic($this->last_statistic_id, $property, $var);
    }

    private function persistUserVariableIntoStatistic($sid, $property, $var) {
        $query = "INSERT INTO user_variable (FK_statistics, property, var) VALUES ('$sid', '$property', '$var')";
        mysql_query($query) or die ("Error in query: $query. " . mysql_error());
        return mysql_insert_id();
    }
}

?>