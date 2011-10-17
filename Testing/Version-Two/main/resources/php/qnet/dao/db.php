<?php

namespace Qnet\Dao;

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