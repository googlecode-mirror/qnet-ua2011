<?php
/*if($controller->hasMoreTrackingNotifications()) {
    echo '<div class="post">
        <h2 class="title">Notifications</h2>';*/
        
        $notification =  $controller->nextTrackingNotification();
		//0: Name + LastName
		//1: approved?
		//2: notificationId
        echo '<div id="Req'.$reqNum.'">';
        if($notification[1]){
			echo $notification[0] . " has accepted your follow request!";
            echo '<input type="button" class="button2" value="OK" onclick="responseReq(' . $notification[2] . ',' . $reqNum .',2)" />';
		}else{
			echo $notification[0] . " wants to follow you! ";
            echo '<input type="button" class="button2" value="Accept" onclick="responseReq(' . $notification[2] . ',' . $reqNum .',1)" />';
            echo '<input type="button" class="button2"  value="Reject" onclick="responseReq(' . $notification[2] . ',' . $reqNum .',0)" />';
		}
        echo '</div>';
	    $reqNum++;

?>