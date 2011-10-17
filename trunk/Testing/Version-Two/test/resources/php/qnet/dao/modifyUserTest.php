<?php
/**
 * Created by IntelliJ IDEA.
 * User: Tomas Alabes
 * Date: 15/09/2010
 * Time: 18:42:45
 * To change this template use File | Settings | File Templates.
 */
    require_once dirname(__FILE__) . '\..\util.php';
    require_dao('userDao');
    use Qnet\Dao\UserDAO;
            $userDao = new UserDao();
            $uid = 1;
            $user = $userDao->selectUserById($uid);
             $user->lastName = "Gimenez";
            $user->password = "dg";
            $user->name ="Daniel";

        $userDao->updateUser($user, $uid);

		 $userUpdated = $userDao->selectUserById($uid);

        if(     $userUpdated->password!=$user->password ||
		        $userUpdated->lastName!=$user->lastName ||
		        $userUpdated->name!=$user->name

            ){
	                          echo "can not update user";
        }



 ?>