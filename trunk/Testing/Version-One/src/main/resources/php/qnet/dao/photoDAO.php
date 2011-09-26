<?php
namespace Qnet\Dao;
    require_once dirname(__FILE__) . '\..\util.php';
    require_db();


    class photoDAO {

        public function getPhotoByUserId($userId) {
            $connector = new DBConnector();
            $connection = $connector->createConnection();

            $query = 'SELECT path FROM photo WHERE fk_id_user='.$userId;
            $result = mysql_query($query) or die ("Error in query: $query. " . mysql_error());
            if(!$result || mysql_num_rows($result) == 0) {
                return "/images/profilePhotos/defaulticon.jpg";
            }else{
            $data = mysql_fetch_assoc($result);
            return $data['path'];
                }
        }

        public function upLoadPhoto($userId, $name, $extension,$path,$size) {
            $connector = new DBConnector();
            $connection = $connector->createConnection();

            $query = "INSERT INTO photo (name,extension,path,fk_id_user,size_kb) VALUE ('$name','$extension','$path','$userId', '$size');";
            mysql_query($query) or die ("Error in query: $query. " . mysql_error());
            mysql_close($connection);

        }

        public function deletePhoto($userId){
             $connector = new DBConnector();
            $connection = $connector->createConnection();
            $query = 'DELETE FROM photo WHERE fk_id_user='.$userId;
            mysql_query($query) or die ("Error in query: $query. " . mysql_error());
            mysql_close($connection);

        }

      

    }
