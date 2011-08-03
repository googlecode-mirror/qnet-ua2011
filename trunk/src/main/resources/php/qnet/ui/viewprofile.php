<?php include "fragment/head.php";?>
    <?php include "fragment/header.php"; ?>
    <?php
        require_once dirname(__FILE__) . '\..\util.php';
        require_controller('profilecontroller');
        require_controller('photoController');
        use Qnet\Controller\ProfileController;
        use Qnet\Controller\PhotoController;
        $controller = new ProfileController();
        $photoController=new PhotoController();
        $hasError=$_GET['error'];
		$isViewProfile = true;
    ?>
<body >
<div id="wrapper">
    <div id="page">
        <div id="content">

		<?php
			$reqNum = 0;
		    while($controller->hasMoreElements()) {
			    include "panel/".$controller->getNextElementUI().".php";
		    }
		?>

        </div>
        <?php include "fragment/sidebar.php"; ?>
        <div style="clear: both;">&nbsp;</div>
    </div>
    <?php include "fragment/footer.php"; ?>
</div>
</body>
</html>