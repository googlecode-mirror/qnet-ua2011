<?php

namespace Qnet\Dao;
require_once dirname(__FILE__) . '\..\util.php';
require_db();
require_model('User');
use Qnet\Model\User;

class QueryDAO {

    function getQueriesByUserId($user) {
        $connector = new DBConnector();
        $connection = $connector->createConnection();

        $query = 'SELECT id, title, date FROM queries WHERE FK_users='.$user.' ORDER BY date DESC';
        $result = mysql_query($query) or die ("Error in" . $query);
        $ansTitles = array();
        $ansDates = array();
        while($row = mysql_fetch_assoc($result)) {
            $ansTitles[$row['id']] = $row['title'];
	        $ansDates[$row['id']] = $row['date'];
        }

        mysql_free_result($result);
        mysql_close($connection);

        return array($ansTitles, $ansDates);
    }

    function getAllQueries() {
        $connector = new DBConnector();
        $connection = $connector->createConnection();

        $query = 'SELECT id, title, date FROM queries ORDER BY date DESC';
        $result = mysql_query($query) or die ("Error in" . $query);
        $ansTitles = array();
        $ansDates = array();
        while($row = mysql_fetch_assoc($result)) {
            $ansTitles[$row['id']] = $row['title'];
            $ansDates[$row['id']] = $row['date'];
        }

        mysql_free_result($result);
        mysql_close($connection);

        return array($ansTitles, $ansDates);
    }

    function getQuestionsByQueryId($query) {
        $connector = new DBConnector();
        $connection = $connector->createConnection();
        $sql = 'SELECT id, text FROM question WHERE FK_queries='.$query;
        $result = mysql_query($sql) or die ("Error in ".$sql);
        $ans = array();
        while($row = mysql_fetch_assoc($result)) {
            $ans[$row['id']] = $row['text'];
        }

        mysql_free_result($result);
        mysql_close($connection);

        return $ans;
    }

    function getOptionsByQuestionId($question) {
        $connector = new DBConnector();
        $connection = $connector->createConnection();

        $result = mysql_query('SELECT id, number, text FROM qoption WHERE FK_question='.$question) or die ("Error 4");
        $ans = array();
        while($row = mysql_fetch_assoc($result)) {
            $ans[$row['id']] = $row['number'] . ": " . $row['text'];
        }

        mysql_free_result($result);
        mysql_close($connection);

        return $ans;
    }

	public function getSegmentsByQueryId($query) {
        $connector = new DBConnector();
        $connection = $connector->createConnection();

        $result = mysql_query('SELECT property, value FROM qsegment WHERE FK_queries='.$query) or die ("Error");
        $ans = array();
		$i = 0;
        while($row = mysql_fetch_assoc($result)) {
            $ans[$i++] = array($row['property'], $row['value']);
        }

        mysql_free_result($result);
        mysql_close($connection);

        return $ans;
	}
    public function getQueryById($qid) {
        $connector = new DBConnector();
        $connection = $connector->createConnection();

        $result = mysql_query('SELECT title, FK_users as uid FROM queries WHERE id='.$qid) or die ("Error 5");//TODO DATE
        $row = mysql_fetch_assoc($result);

        mysql_free_result($result);
        mysql_close($connection);

        return $row;
    }

	public function getQueryIdByQueryTitle($queryTitle) {
		$connector = new DBConnector();
        $connection = $connector->createConnection();

        $query = 'SELECT id FROM queries WHERE title="'.$queryTitle.'"';
        $result = mysql_query($query);
		if(!$result){
			return -1;
		}
		$row = mysql_fetch_row($result);
		mysql_close($connection);
		return $row[0];
	}

    public function getQueriesByPartialString($partialName){
        $connector = new DBConnector();
        $connection = $connector->createConnection();

        $query = 'SELECT id, title, date FROM queries q WHERE q.title LIKE "' .$partialName .'%" ORDER BY date DESC';
        $result = mysql_query($query) or die ("Error in query: $query. " . mysql_error());
        $ansTitles = array();
        $ansDates = array();
        while($row = mysql_fetch_assoc($result)) {
            $ansTitles[$row['id']] = $row['title'];
            $ansDates[$row['id']] = $row['date'];
        }

        mysql_free_result($result);
        mysql_close($connection);

        return array($ansTitles, $ansDates);
    }

	public function getQueryTitleById($qid) {
		$connector = new DBConnector();
        $connection = $connector->createConnection();

        $result = mysql_query('SELECT title FROM queries WHERE id='.$qid) or die ("Error 6");
        $row = mysql_fetch_row($result);

        mysql_free_result($result);
        mysql_close($connection);

        return $row;
	}

	public function getQueryDateById($qid) {
		$connector = new DBConnector();
        $connection = $connector->createConnection();

        $result = mysql_query('SELECT date FROM queries WHERE id='.$qid) or die ("Error 7");
        $row = mysql_fetch_row($result);

        mysql_free_result($result);
        mysql_close($connection);

        return $row[0];
	}

}