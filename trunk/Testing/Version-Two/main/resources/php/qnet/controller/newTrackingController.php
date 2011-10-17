<?php
		namespace Qnet\Controller;
		require_once dirname(__FILE__) . '\..\util.php';
        check_session();
		require_dao('trackingsDAO');
        use Qnet\Dao\TrackingsDAO;

        $followed = $_GET['uid'];
        $follower = getUID();
		$trackingsDAO = new TrackingsDAO();
        $trackingsDAO->newTracking($follower, $followed);

?>
