<?php include "fragment/head.php";?>
<body>
<div id="wrapper">
    <?php include "fragment/header.php"; ?>
    <?php
        require_once dirname(__FILE__) . '\..\util.php';
require_controller('listqueriescontroller');
require_controller('profilecontroller');
require_controller('photoController');
use Qnet\Controller\ListQueriesController;
$controller = new ListQueriesController();
use Qnet\Controller\PhotoController;
$photoController=new PhotoController();

?>

    <div id="page">
        <div id="content">
            <div class="post">
                <h2 class="title">Select a query to answer!</h2>
                <div class="entry">
                <?php
                    while($controller->hasMoreQueries()) {
    $controller->nextQuery();
    echo '<p>'.$controller->getQueryLink().'</p>';
}
?>
                </div>
            </div>
        </div>
        <?php include "fragment/sidebar.php"; ?>
        <div style="clear: both;">&nbsp;</div>
    </div>
    <?php include "fragment/footer.php"; ?>
</div>
</body>
</html>