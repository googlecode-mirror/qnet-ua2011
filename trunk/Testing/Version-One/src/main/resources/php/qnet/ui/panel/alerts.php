<?php

        $notification =  $controller->nextFollowingsNotification();
		//1: Name + LastName
		//0: uid
		//2: q/s id
		echo '<div>';
		echo $notification[1] . " has created a new ";
		if(substr($notification[2],0,1) == 'q'){
			echo "query";
		}else{
			echo "statistic";
		}
		echo ": <a href='viewprofile.php?uid=".$notification[0]. "'>" .substr($notification[2],1)."</a>";

		echo '</div>';

?>