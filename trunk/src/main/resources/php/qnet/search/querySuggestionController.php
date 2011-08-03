<?php

namespace Qnet\Controller;
    require_once dirname(__FILE__) . '\..\..\util.php';
    require_dao('QueryDAO');
	require_controller('listqueriescontroller');
	require_dao('userDAO');
    use Qnet\Dao\QueryDAO;
	use Qnet\Dao\UserDAO;
	use Qnet\Controller\ListQueriesController;

    $searchQuery = $_GET["q"];

    if ($searchQuery != null) {
        $userDaoIns = new QueryDAO();
        $queriesArray = $userDaoIns->getQueriesByPartialString($searchQuery);
        $queriesArray = $queriesArray[0];

		$uid = getUID();
		$udao = new UserDAO();
		$queriesArray = ListQueriesController::filterQueries($queriesArray, $udao->selectUserById($uid));

        $arraySize = count($queriesArray);

        $answer = "";
        foreach (array_values($queriesArray) as $queryname) {
            $answer = $answer . $queryname . "\n";
        }

        echo $answer;
    }

    ?>