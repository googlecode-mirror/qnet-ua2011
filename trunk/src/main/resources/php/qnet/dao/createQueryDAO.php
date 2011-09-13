<?php

namespace Qnet\Dao;
require_once dirname(__FILE__) . '\..\util.php';
require_db();

class CreateQueryDAO {

    private $connection;
    private $last_query_id;
    private $last_question_id;

    public function initTransaction() {
        $connector = new DBConnector();
        $this->connection = $connector->createConnection();
    }

    public function endTransaction() {
        mysql_close($this->connection);
    }

    public function persistNewQuery($title, $uid) {
	    $date = date('Y-m-d H:i:s');
        $query = "INSERT INTO queries (title, FK_users, date) VALUES ('$title', $uid, '$date')";
        mysql_query($query) or die ("Error in query: $query. " . mysql_error());
        $this->last_query_id = mysql_insert_id();
        return $this->last_query_id;
    }

	public function persistSegment($property, $value){
		$this->persistSegmentIntoQuery($property, $value, $this->last_query_id);			
	}

	public function persistSegmentIntoQuery($property, $value, $queryID){
		$query = "INSERT INTO qsegment (FK_queries, property, value) VALUES ('$queryID', '$property', '$value')";
        mysql_query($query) or die ("Error in query: $query. " . mysql_error());
	}

    public function persistQuestion($text) {
        $textAux = mysql_real_escape_string($text);
        return $this->persistQuestionIntoQuery($textAux, $this->last_query_id);
    }

    public function persistQuestionIntoQuery($text, $queryID) {
        $textAux = mysql_real_escape_string($text);
        $query = "INSERT INTO question (text, FK_queries) VALUES ('$textAux', '$queryID')";
        mysql_query($query) or die ("Error in query: $query. " . mysql_error());
        $this->last_question_id = mysql_insert_id();
        return $this->last_question_id;
    }

    public function persistAnswer($text, $number) {
        $textAux = mysql_real_escape_string($text);
        return $this->persistAnswerIntoQuestion($textAux, $number, $this->last_question_id);
    }

    public function persistAnswerIntoQuestion($text, $number, $questionID) {
        $textAux = mysql_real_escape_string($text);
        $query = "INSERT INTO qoption (text, number, FK_question) VALUES ('$textAux', '$number', '$questionID')";
        mysql_query($query) or die ("Error in query: $query. " . mysql_error());
        return mysql_insert_id();
    }

    public function deleteQueryByID($queryID) {
        $connector = new DBConnector();
        $connection = $connector->createConnection();
        $query = "DELETE FROM queries WHERE id=$queryID";
        mysql_query($query) or die ("Error in query: $query. " . mysql_error());
        mysql_close($connection);
        return $queryID;
    }
}

?>