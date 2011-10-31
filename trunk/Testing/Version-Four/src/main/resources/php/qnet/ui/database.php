<?php
mysql_connect ("localhost", "root", "password") or die ('I cannot connect to the database because: ' . mysql_error());
mysql_select_db ("qnet");
?>