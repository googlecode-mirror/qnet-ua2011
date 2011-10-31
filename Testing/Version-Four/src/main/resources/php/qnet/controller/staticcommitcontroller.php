<?php

namespace Qnet\Controller;
require_once dirname(__FILE__) . '\..\util.php';
require_dao('createStatisticsDAO');
use Qnet\Dao\CreateStatisticsDAO;

$uid=getUID();
$qid=$_POST['qid'];
$queryName=$_POST['queryname'];

$dao = new CreateStatisticsDAO();
$dao->initTransaction();
$sid = $dao->persistNewStatistic($queryName, $uid, $qid);
$j = 0;
for($i = 0; $i < 3; $i++, $j++) {
    $varValue = $_POST['var'.($i+1)];
    switch ($varValue) {
        case "NONE":
            $j--;
            break;
        case "AGE":
        case "GENDER":
        case "MARITAL_STATUS":
        case "STUDIES":
        case "LOCATION":
        case "RELIGION":
            $dao->persistUserVariable($varValue, $j);
            break;
        default:
            $dao->persistQuestionVariable(intval($varValue), $j);
    }
}
$dao->endTransaction();

header("Location: /Qnet/target/classes/php/qnet/ui/newstatistic.php?uid=".$uid."&qid=".$qid."&commit=ok");

?>