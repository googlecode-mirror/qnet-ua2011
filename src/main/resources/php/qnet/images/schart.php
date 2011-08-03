<?php

require_once dirname(__FILE__) . '\..\util.php';
require_abs('images/graphs/phpgraphlib.php');
require_abs('images/graphs/phpgraphlib_pie.php');
require_controller('statisticsGraphicsController');
use Qnet\Controller\StatisticsGraphicsController;

$sid = $_GET['sid'];
$ctrl = new StatisticsGraphicsController();
$ctrl->computeStatistic($sid);

if(!$ctrl->isDrawable()) {
    echo 'Cannot draw this statistic.';
} else {
    $big = $_GET['size'] == 'big';
    $graph=new PHPGraphLib($big ? 800 : 400,$big ? 400 : 200);
    $graph->addData($ctrl->getData(0),$ctrl->getData(1),$ctrl->getData(2),$ctrl->getData(3),$ctrl->getData(4));
    if($ctrl->hasZ()) {
        $graph->setLegend(true);
        $graph->setLegendTitle($ctrl->getLegend(0), $ctrl->getLegend(1), $ctrl->getLegend(2), $ctrl->getLegend(3), $ctrl->getLegend(4));
    }

    $graph->setXValuesHorizontal(true);

    $graph->createGraph();
}

?>