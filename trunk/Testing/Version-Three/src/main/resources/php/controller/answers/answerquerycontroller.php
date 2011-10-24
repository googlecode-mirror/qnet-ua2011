<?php

namespace Qnet\Controller;
require_once dirname(__FILE__) . '\..\..\util.php';
require_dao('queryDAO');
use Qnet\Dao\QueryDAO;

class AnswerQueryController {

    private $qdao;
    private $qid;
    private $qname;
    private $questions;
    private $questionIx = -1;
    private $questionId;

    private $quid;

    private $qoptions;
    private $qoptionsIx = -1;
    private $qoptionsId;

    function __construct() {
        $this->uid = getUID();
        $this->qid = $_GET['qid'];
        $this->qdao = new QueryDAO();
        $query = $this->qdao->getQueryById($this->qid);
        $this->qname = $query['title'];
        $this->quid = $query['uid'];
        $this->questions = $this->qdao->getQuestionsByQueryId($this->qid);
        $this->questionIx = -1;
    }

    public function getOwnerUid() {
        return $this->quid;
    }

    public function backToStart() {
        $this->questionIx = -1;
    }

    public function getQueryName() {
        return $this->qname;
    }

    public function hasMoreQuestions() {
        return $this->questionIx+1 < count($this->questions);
    }

    public function moveNext() {
        $this->questionIx++;
        $ids = array_keys($this->questions);
        $this->questionId = $ids[$this->questionIx];
    }

    public function nextQuestion() {
        $this->moveNext();
        $this->qoptions = $this->qdao->getOptionsByQuestionId($this->questionId);
        $this->qoptionsIx = -1;
    }

    public function getQuestionName() {
        return $this->questions[$this->questionId];
    }

    public function getQuestionId() {
        return $this->questionId;
    }

    public function hasMoreOptions() {
        return $this->qoptionsIx+1 < count($this->qoptions);
    }

    public function nextOption() {
        $this->qoptionsIx++;
        $ids = array_keys($this->qoptions);
        $this->qoptionsId = $ids[$this->qoptionsIx];
    }

    public function getOptionText() {
        return $this->qoptions[$this->qoptionsId];
    }

    public function getOptionId() {
        return $this->qoptionsId;
    }
}
?>