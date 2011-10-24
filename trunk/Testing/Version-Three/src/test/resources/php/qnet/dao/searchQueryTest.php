<?php
/**
 * Created by IntelliJ IDEA.
 * User: Tomi
 * Date: 23/06/2010
 * Time: 10:08:29
 * To change this template use File | Settings | File Templates.
 */

use \PHPUnit_Framework_TestCase;
require_once dirname(__FILE__) . '\..\util.php';
require_dao('queryDAO');
require_dao('createQueryDAO');
use Qnet\Dao\QueryDAO;
use Qnet\Dao\CreateQueryDAO;

		$cqd = new CreateQueryDAO();
		$qd = new QueryDAO();

        $cqd->initTransaction();

		$expectedId = $cqd->persistNewQuery("testQuery",1);
        if($expectedId == null) {
            echo "Coudn't persist query";
        }
        $foundId = $qd->getQueryIdByQueryTitle("testQuery");
        if($expectedId != $foundId) {
            echo "Queries id doesn't match. Expected $expectedId, found $foundId";
        }
