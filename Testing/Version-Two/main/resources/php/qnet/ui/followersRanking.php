<?php include "fragment/head.php"; ?>
<?php include "fragment/header.php"; ?>

<?php
        require_once dirname(__FILE__) . '\..\util.php';
require_controller('profilecontroller');
require_controller('photoController');
require_dao('trackingsDAO');
use Qnet\Controller\ProfileController;
use Qnet\Controller\PhotoController;
$controller = new ProfileController();
$photoController = new PhotoController();
$photoPath = $photoController->getPhoto();
$hasError = $_GET['error'];
$trackingsDAO = new \Qnet\Dao\TrackingsDAO();
$ranking = $trackingsDAO->getRanking();
//$message=$photoController->getMessage($hasError);
?>
<body>
<div id="wrapper">

    <div id="page">

        <div id="content">
            <h1> FOLLOWERS RANKING </h1>

            <br> </br> <br> </br>

            <table>
                <table id="table" border="5">
                    <tr>
                        <th>Name</th>
                        <th>number of followers</th>
                    </tr>
<?php

                    $count = 0;



                    foreach ($ranking as $key => $value) {
                        $count=$count + 1;
                        if($count > 10){
                            break; }
                            ?>


    <tr>
        <td>
            <?php
        $name = $value["name"];
            $lastname = $value["lastname"];
            echo ($name . "," . $lastname);
            ?>
        </td>
                        <td>
            <?php
            echo $value["quantity"];
                ?>
                        </td>

                        <?php  }?>
                </table>

                <!--        		--><?php
//			$reqNum = 0;
//		    while($controller->hasMoreElements()) {
//			    include "panel/".$controller->getNextElementUI().".php";
//		    }
//		?>

        </div>
        <?php include "fragment/sidebar.php"; ?>
        <div style="clear: both;">&nbsp;</div>
    </div>
    <?php include "fragment/footer.php"; ?>
</div>
</body>
</html>