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
$trackingsDAO=new \Qnet\Dao\TrackingsDAO();
$ranking= $trackingsDAO->getRanking();
//$message=$photoController->getMessage($hasError);
?>
<body>
<div id="wrapper">

    <div id="page">

        <div id="content">
            <h1>RANKING</h1>

            <br> </br> <br> </br>

            <table border="1">
                <table id="table" border="5">
                    <?php
                        foreach($ranking as $key=>$value){
                        $name=$value["name"];
                        $lastname=$value["lastname"];
                        $quantity=$value["quantity"];
                        echo ($name.",".$lastname."".$quantity );
                    }
?>
                    <tr>
                        <th>Name</th>
                        <th>number of followers</th>
                    </tr>
                    <tr>
                        <td>xxxxxxxx</td>
                        <td>;
                       </td>
                    </tr>
                    <tr>
                        <td>xxxxxxxx</td>
                        <td>xxxxxxxx</td>
                    </tr>
                    <tr>
                        <td>xxxxxxxx</td>
                        <td>xxxxxxxx</td>
                    </tr>
                    <tr>
                        <td>xxxxxxxx</td>
                        <td>xxxxxxxx</td>
                    </tr>
                    <tr>
                        <td>xxxxxxxx</td>
                        <td>xxxxxxxx</td>
                    </tr>
                    <tr>
                        <td>xxxxxxxx</td>
                        <td>xxxxxxxx</td>
                    </tr>
                    <tr>
                        <td>xxxxxxxx</td>
                        <td>xxxxxxxx</td>
                    </tr>
                    <tr>
                        <td>xxxxxxxx</td>
                        <td>xxxxxxxx</td>
                    </tr>
                    <tr>
                        <td>xxxxxxxx</td>
                        <td>xxxxxxxx</td>
                    </tr>
                    <tr>
                        <td>xxxxxxxx</td>
                        <td>xxxxxxxx</td>
                    </tr>
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