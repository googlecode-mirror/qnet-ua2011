<?php

namespace Qnet\Controller;
require_once dirname(__FILE__) . '\..\util.php';
require_model('User');
require_dao('createQueryDAO');
use Qnet\Dao\CreateQueryDAO;
use Qnet\Model\User;

$queryName=$_POST['queryname'];
$qlength=$_POST['qlength'];
$filterslength=$_POST['filterslength'];
$uid=getUID();

$dao = new CreateQueryDAO();
$dao->initTransaction();
$dao->persistNewQuery($queryName, $uid);

for ($i = 0; $i < $qlength ; $i++) {

    $dao->persistQuestion($_POST['questionname' . $i]);
    switch($_POST['answers' . $i]) {
        case 'yesno':
            $dao->persistAnswer("Yes", 0);
            $dao->persistAnswer("No", 1);
            break;
        case 'lml':
            $dao->persistAnswer("A lot", 0);
            $dao->persistAnswer("Medium", 1);
            $dao->persistAnswer("Low", 2);
            break;
        case 'mf':
            $dao->persistAnswer("Male", 0);
            $dao->persistAnswer("Female", 1);
            break;
        case 'please':
            $dao->persistAnswer("Yes please!", 0);
            $dao->persistAnswer("No thanks!", 1);
            break;

    }
}

for ($i = 0; $i < $filterslength ; $i++) {
    $cat = $_POST['filtercat' . $i];
    $pop = User::indexOfSelectValue($cat, $_POST['filterpop' . $i]);
    $dao->persistSegment($cat, $pop);
}


$dao->endTransaction();

header("Location: /Qnet/target/classes/php/qnet/ui/newquery.php?commit=ok");

?>