<?php
/**
 * Created by IntelliJ IDEA.
 * User: Tomas Alabes
 * Date: 28/04/2010
 * Time: 20:33:31
 * To change this template use File | Settings | File Templates.
 */
namespace Qnet\Dao;

    require_once dirname(__FILE__) . '\..\util.php';
    require_dao('userDAO');
    require_model('user');
    use Qnet\Dao\UserDAO;
    use Qnet\Model\User;

    $dao = new UserDAO();
    $dummyUser = new User("tomas", "alabes", "pass", "13/8", "male", "univ", "Austral", "single", "Arg", "None", 1);
    if ($dao->registerUser($dummyUser) == null) {
        echo "Could not register user.";
    }

