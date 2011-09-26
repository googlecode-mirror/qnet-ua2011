<?php

require_once dirname(__FILE__) . '\..\util.php';
require_dao('answersDAO');
require_abs('images/graphs/phpgraphlib.php');
require_abs('images/graphs/phpgraphlib_pie.php');
use Qnet\Dao\AnswersDAO;

$questionId = $_GET['qid'];
$title = $_GET['title'];
$dao = new AnswersDAO();
$dao->selectAnswersByQuestionId($questionId);

$graph = new PHPGraphLibPie(400, 200);

$data = array();
foreach($dao->getLabelsAndCountsMap() as $label => $count) {
    $data[$label] = $count;
}
$graph->addData($data);
if($title != null) {
    $graph->setTitle($title);
}
//$graph->setLabelTextColor('50,50,50');
//$graph->setLegendTextColor('50,50,50');
$graph->createGraph();

?>