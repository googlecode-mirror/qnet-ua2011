<?php
		namespace Qnet\Controller;
		require_once dirname(__FILE__) . '\..\util.php';
        check_session();
		require_dao('trackingsDAO');
        use Qnet\Dao\TrackingsDAO;

		$trackingsDAO = new TrackingsDAO();
        if($_GET['response'] == 1) {
		    $trackingsDAO->approvalAccepted($_GET['notificationId']);
        } else {
            $trackingsDAO->notificationReceived($_GET['notificationId']);
        }
?>
