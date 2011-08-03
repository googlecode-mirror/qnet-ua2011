<?php


require_once '../util.php';
require_db();
$connector = new DBConnector();
$connection = $connector->createConnection();

$name="photo1";
$extension="jpg";
$path="path";
$userId=1    ;
$size=123;

$query = "INSERT INTO photo (name,extension,path,fk_id_user,size_kb) VALUE ('$name','$extension','$path','$userId', '$size');";
$result = mysql_query($query);
if(!$result) return "error photo";


$userId=12   ;
$query = 'DELETE FROM photo WHERE fk_id_user='.$userId;
$result = mysql_query($query);
$rowsMysql=mysql_affected_rows();

if($rowsMysql<0){
    return "error i cant delete more records";
}

if(!$result) return "error photo";

mysql_close($connection) ;

class DBConnector {

    function createConnection() {
        $host = "127.0.0.1:3306";
        $user = "root";
        $pass = "password";
        $db = "qnet";

            // open connection
        $connection = mysql_connect($host, $user, $pass) or die ("Unable to connect!");

            // select database
        mysql_select_db($db) or die ("Unable to select database!");

        return $connection;
    }
}


?>