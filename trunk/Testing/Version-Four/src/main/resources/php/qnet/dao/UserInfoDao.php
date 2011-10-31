<?php
namespace Qnet\Dao;
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class UserInfoDao{

    public function construct__(){


    }

    /**
     *
     * @param <type> $userInstance
     */
    public function getUserInfo($userInstance){

        $id=$userImstance->getId();



    }

    /**
     *
     * @param <type> $id the user id to modify the values here
     * @param <type> $userInstanceNewValues  the new values of the user info
     *                                          that are in the user instance
     */
    public function modifyUserInfo($id,$userInstanceNewValues){

        $connector = new DBConnector();
        $connection = $connector->createConnection();
        $userId=$userInstanceNewValues->getId();

        $gender=$userInstanceNewValues->gender;
        $maritalStatus=$userInstanceNewValues->maritalSt;
        $studies=$userInstanceNewValues->studies;
        $institutionName=$userInstanceNewValues->getInstitutionName();
        $country=$userInstanceNewValues->getCountry();
        $religion=$userInstanceNewValues->getReligion();

        $query = "UPDATE userinfo set gender='".$gender."', maritalSt='".$maritalStatus."', studies='".$studies."' , InstitutionName='".$institutionName."'  , currentLocation='".$country."' , religion='".$religion."'  where FK_users=".$userId;
        mysql_query($query) or die ("Error in query modifying user info : $query. " . mysql_error()." and the user id is".$id);
        mysql_close($connection);

    }
    



}

?>
