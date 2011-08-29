<?php

namespace Qnet\Controller;
    require_once dirname(__FILE__) . '\..\util.php';
    require_dao("photoDAO");
    use Qnet\dao\photoDAO;
    require_controller("SessionController");
    use Qnet\Controller\SessionController;

   $actionId=$_GET['actionId'];

    if($actionId==1){
        $photoController=new PhotoController();
        $photoController->uploadAndRedirect();


    }


    class PhotoController{

        private $photoDao;

        private $sessionController;

        public function __construct(){
            $this->photoDao=new PhotoDao();
            $this->sessionController=new SessionController();
        }

        public function uploadPhoto(){
            $mime= $_FILES["uploadedfile"]["type"];
            $type=substr ($mime,6,strlen($mime)-1);
            if($type=="jpeg"){
                $size= $_FILES["uploadedfile"]["size"] / 1024;
                $userID=$this->sessionController->getUID();
                $path="/images/profilePhotos/$userID.$type";

                $this->photoDao->deletePhoto($userID);
                $this->photoDao->upLoadPhoto($userID,$userID,$type,$path ,$size);
                $fileName=$userID.".".$type;
                $nombre_tmp = $_FILES["uploadedfile"]["tmp_name"];
                copy($nombre_tmp,"../images/profilePhotos/$fileName");
            }

       }
           public function uploadAndRedirect(){

               $this->uploadPhoto();
               header("Location: /Qnet/target/classes/php/qnet/ui/viewProfile.php");
           }



        public function getPhoto(){
            $userID=$this->sessionController->getUID();
            $path=$this->photoDao->getPhotoByUserId($userID);
            return $path;
        }


    }









