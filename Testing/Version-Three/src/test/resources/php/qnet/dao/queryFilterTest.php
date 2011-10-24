<?php

require_once dirname(__FILE__) . '\..\util.php';
require_dao('userDAO');
require_controller('listqueriescontroller');
use Qnet\Controller\ListQueriesController;
use Qnet\Dao\UserDAO;

$udao = new UserDAO();
$applies = $udao->selectUserById(3);
$doesNot = $udao->selectUserById(1);

$queries = array();
$queries[1] = "Chocolate";

$filtered = ListQueriesController::filterQueries($queries, $applies);
if($filtered[1] != "Chocolate") {
	echo 'Appliying user did not find Chocolate query';
};

$filtered = ListQueriesController::filterQueries($queries, $doesNot);
if($filtered[1] == "Chocolate") {
	echo 'Not appliying user found Chocolate query';
}

?>