<?php

namespace Qnet\Controller;
require_once dirname(__FILE__) . '\..\..\util.php';
require_dao('queryDAO');
require_dao('answersDAO');
use Qnet\Dao\QueryDAO;
use Qnet\Dao\AnswersDAO;

$uid=getUID();
$qid=$_POST['qid'];

$dao = new AnswersDAO();
$qdao = new QueryDAO();
$questions = $qdao->getQuestionsByQueryId($qid);
$aid = $dao->persistAnswer($uid, $qid);
foreach (array_keys($questions) as $id) {
    $dao->persistAnswerOption($aid, $_POST['question'.$id]);
}
header("Location: /Qnet/target/classes/php/qnet/ui/answerquery.php?qid=".$qid."&commit=ok");
?>