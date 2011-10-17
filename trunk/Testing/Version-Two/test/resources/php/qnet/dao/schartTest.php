<?php
/**
 * Created by IntelliJ IDEA.
 * User: Tomas Alabes
 * Date: 15/09/2010
 * Time: 18:13:23
 * To change this template use File | Settings | File Templates.
 */

require_once dirname(__FILE__) . '\..\util.php';
require_abs('images/graphs/phpgraphlib.php');
require_abs('images/graphs/phpgraphlib_pie.php');
require_controller('statisticsGraphicsController');
use Qnet\Controller\StatisticsGraphicsController;

for($i=1;$i<4;$i++){
$sid = $i;
$ctrl = new StatisticsGraphicsController();
$ctrl->computeStatistic($sid);
if(!$ctrl->isDrawable()) {
    echo 'Cannot draw this statistic.';
}
	$ctrl->getData(0);
	$ctrl->getData(1);
	$ctrl->getData(2);
	$ctrl->getData(3);
	$ctrl->getData(4);
    if($ctrl->hasZ()) {
        $ctrl->getLegend(0);
        $ctrl->getLegend(1);
        $ctrl->getLegend(2);
        $ctrl->getLegend(3);
        $ctrl->getLegend(4);
    }
}
?>