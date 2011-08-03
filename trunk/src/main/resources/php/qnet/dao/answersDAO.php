<?php

namespace Qnet\Dao;
require_once dirname(__FILE__) . '\..\util.php';
require_db();

class AnswersDAO {

    private $selectionsCount;
    private $labels;

    public function getOptionName($qid, $option) {
        $connector = new DBConnector();
        $connection = $connector->createConnection();

        $query = 'SELECT text FROM qoption WHERE FK_question='.$qid.' AND number='.$option;
        $result = mysql_query($query) or die ("Error in query: $query. " . mysql_error());
        $answer = mysql_fetch_assoc($result);
        $text = $answer['text'];
        mysql_free_result($result);
        mysql_close($connection);
        return $text;
    }

    public function getOptionNames($qid) {
        $connector = new DBConnector();
        $connection = $connector->createConnection();

        $query = 'SELECT text, number FROM qoption WHERE FK_question='.$qid.' order by number';
        $result = mysql_query($query) or die ("Error in query: $query. " . mysql_error());
        $qoptions = array();
        while($answer = mysql_fetch_assoc($result)){
            $qoptions[$answer['number']-1] = $answer['text'];
        }
        mysql_free_result($result);
        mysql_close($connection);
        return $qoptions;
    }

    public function getOptionsMap($qid) {
        $connector = new DBConnector();
        $connection = $connector->createConnection();

        $qoptions = array();

        $query = 'SELECT id, number FROM qoption WHERE FK_question = '.$qid;
        $result = mysql_query($query) or die ("Error in query: $query. " . mysql_error());
        while($answer = mysql_fetch_assoc($result)){
            $qoptions[$answer['id']] = $answer['number'];
        }
        mysql_free_result($result);
        mysql_close($connection);
        return $qoptions;
    }

    public function getAswersOptionsMap($aid) {
        $connector = new DBConnector();
        $connection = $connector->createConnection();

        $qoptions = array();

        $query = 'SELECT FK_qoption AS oid FROM qanswer_qoption WHERE FK_qanswer = '.$aid;
        $result = mysql_query($query) or die ("Error in query: $query. " . mysql_error());
        $i = 0;
        while($answer = mysql_fetch_assoc($result)){
            $qoptions[$i++] = $answer['oid'];
        }
        mysql_free_result($result);
        mysql_close($connection);
        return $qoptions;
    }

    public function getUserByAnswersId($aid) {
        $connector = new DBConnector();
        $connection = $connector->createConnection();

        $query = 'SELECT FK_users AS uid FROM qanswer WHERE id = '.$aid;
        $result = mysql_query($query) or die ("Error in query: $query. " . mysql_error());
        $answer = mysql_fetch_assoc($result);
        $uid = $answer['uid'];
        mysql_free_result($result);
        mysql_close($connection);
        return $uid;
    }


    public function selectAnswersByQuestionId($question) {
        $connector = new DBConnector();
        $connection = $connector->createConnection();
        $this->labels = array();
        $query = 'SELECT id, text FROM qoption where FK_question = '.$question;
        $result = mysql_query($query) or die ("Error in query: $query. " . mysql_error());
        while($answer = mysql_fetch_assoc($result)){
            $this->labels[$answer['id']] = $answer['text'];
            $this->selectionsCount[$answer['id']] = 0;
        }
        mysql_free_result($result);

        $query = 'SELECT x.FK_qoption AS qoption
                    FROM qanswer_qoption x JOIN qanswer a JOIN qoption o
                    WHERE x.FK_qanswer = a.id AND x.FK_qoption = o.id AND o.FK_question = '.$question;
        $result = mysql_query($query) or die ("Error in query: $query. " . mysql_error());

        $this->selectionsCount = array();

        while($answer = mysql_fetch_assoc($result)){
            $this->selectionsCount[$answer['qoption']]++;
        }
        mysql_free_result($result);

        mysql_close($connection);
    }

    public function getQoptionSelectionsCount($qoption) {
        return $this->selectionsCount[$qoption];
    }

    public function getQoptionLabel($qoption) {
        return $this->labels[$qoption];
    }

    public function getLabelsAndCountsMap() {
        $result = array();
        foreach(array_keys($this->labels) as $qid) {
            $result[$this->labels[$qid]] = $this->selectionsCount[$qid];
        }
        return $result;
    }

    public function persistAnswer($uid, $qid) {
        $connector = new DBConnector();
        $connection = $connector->createConnection();

        $query = "INSERT INTO qanswer (FK_queries,FK_users) VALUE ($qid,$uid);";
        mysql_query($query) or die ("Error in query: $query. " . mysql_error());
        $aid = mysql_insert_id();

        mysql_close($connection);
        return $aid;
    }

    public function persistAnswerOption($aid, $oid) {
        $connector = new DBConnector();
        $connection = $connector->createConnection();

        $query = "INSERT INTO qanswer_qoption (FK_qanswer,FK_qoption) VALUE ($aid,$oid);";
        mysql_query($query) or die ("Error in query: $query. " . mysql_error());
        $id = mysql_insert_id();

        mysql_close($connection);
        return $id;
    }

    public function selectAnswersByQueryId($qid) {
        $connector = new DBConnector();
        $connection = $connector->createConnection();

        $ans = array();

        $query = 'SELECT id FROM qanswer where FK_queries = '.$qid;
        $result = mysql_query($query) or die ("Error in query: $query. " . mysql_error());
        $ix = 0;
        while($answer = mysql_fetch_assoc($result)){
            $ans[$ix++] = $answer['id'];
        }
        mysql_free_result($result);
        mysql_close($connection);

        return $ans;
    }
}

?>
