<?php

namespace Qnet\Dao;
require_once dirname(__FILE__) . '\..\util.php';
require_db();

class StatisticsDAO {

    private $current_sid;
    private $title;
	private $timestamp;
    private $qid;
    private $uVars;
    private $qVars;
    private $varsLength;

    function getStatisticsByUserId($user) {
        $connector = new DBConnector();
        $connection = $connector->createConnection();

        $result = mysql_query('SELECT id, title, date FROM statistics WHERE FK_users='.$user.' ORDER BY date DESC') or die ("Error 4s");
        $ans = array();
        $ansDates = array();
        while($row = mysql_fetch_assoc($result)) {
            $ans[$row['id']] = $row['title'];
            $ansDates[$row['id']] = $row['date'];
        }

        mysql_free_result($result);
        mysql_close($connection);

        return array($ans, $ansDates);
    }

    function setCurrentStatistic($sid) {
        $this->current_sid = $sid;

        $connector = new DBConnector();
        $connection = $connector->createConnection();

        $query = 'SELECT title, date, FK_queries FROM statistics WHERE id='.$sid;
        $result = mysql_query($query) or die ("Error in ".$query);
        $row = mysql_fetch_assoc($result);
        $this->title = $row['title'];
        $this->qid = $row['FK_queries'];
        $this->timestamp = $row['date'];
        mysql_free_result($result);

        $result = mysql_query('SELECT property, var FROM user_variable WHERE FK_statistics='.$sid) or die ("Error 2s");
        $this->varsLength = 0;
        $this->uVars = array();
        while($row = mysql_fetch_assoc($result)) {
            $this->uVars[$row['var']] = $row['property'];
            $this->varsLength++;
        }
        mysql_free_result($result);

        $result = mysql_query('SELECT FK_question, var FROM question_variable WHERE FK_statistics='.$sid) or die ("Error 3s");
        $this->qVars = array();
        while($row = mysql_fetch_assoc($result)) {
            $this->qVars[$row['var']] = $row['FK_question'];
            $this->varsLength++;
        }
        mysql_free_result($result);

        mysql_close($connection);
    }

    public function getStatisticTitleById($sid) {
        $connector = new DBConnector();
        $connection = $connector->createConnection();

        $query = 'SELECT title FROM statistics WHERE id='.$sid;
        $result = mysql_query($query) or die ("Error in ".$query);
        $row = mysql_fetch_assoc($result);
        $title = $row['title'];
        mysql_free_result($result);
        mysql_close($connection);

        return $title;
    }

    function getTitle() {
        return $this->title;
    }

    function getVarsQty() {
        return $this->varsLength;
    }

    function getVarType($var) {
        if(array_key_exists($var, $this->uVars)) {
            return "uVar";
        }
        if(array_key_exists($var, $this->qVars)) {
            return "qVar";
        }
    }

    function getVarValue($var) {
        if($this->getVarType($var) == "uVar") {
            return $this->uVars[$var];
        } else if($this->getVarType($var) == "qVar") {
            return $this->qVars[$var];
        }
    }

    public function getQid() {
        return $this->qid;
    }

	public function getTimestamp() {
		return $this->timestamp;
	}
}