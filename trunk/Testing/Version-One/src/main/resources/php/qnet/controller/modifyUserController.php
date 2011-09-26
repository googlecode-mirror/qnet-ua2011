<?php

namespace Qnet\Controller;

    require_once dirname(__FILE__) . '\..\util.php';
    check_session();
    require_model('User');
    require_dao('userDao');
    require_dao('UserInfoDao');
    use Qnet\Model\User;
    use Qnet\Dao\UserDAO;
    use Qnet\Dao\UserInfoDAO;

    $modifyUserController = new ModifyUserController();
    $modifyUserController->modifyUser();

    class ModifyUserController {
        public function modifyUser() {
            $username = $_POST['userName'];
            $userLastName = $_POST['userLastName'];
            $userPassword = $_POST['password'];
            $passwordAgain = $_POST['rePassword'];

            $userDao = new UserDao();
            $userInfoDao=new UserInfoDao();

            $uid = getUID();
            $user = $userDao->selectUserById($uid);

            $user->lastName = $userLastName;
            $user->password = $userPassword;
            $user->name = $username;

            User::readProperties($user, $_POST);
            $user->setInstitutionName($_POST['InstitutionName']);

            $userDao->updateUser($user, $uid);
            $userInfoDao->modifyUserInfo($id,$user);



            

        }
    }

?>