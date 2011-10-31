<?php
/**
 * Created by IntelliJ IDEA.
 * User: Tomas Alabes
 * Date: 09/06/2010
 * Time: 18:10:07
 * To change this template use File | Settings | File Templates.
 */

namespace Qnet\Controller;

require_once dirname(__FILE__) . '\..\util.php';
require_controller("loginController");
require_controller("logoutController");
require_dao('userDAO');
require_model('user');
use Qnet\Dao\UserDAO;
use Qnet\Model\User;
use Qnet\Controller\LoginController;
use Qnet\Controller\LogoutController;

$test = new LogInOutTest();
$test->testLogIn();
$test->testLogOut();
$test->testInvalidLogIn();

class LogInOutTest {

    public function testLogIn() {
		$dao = new UserDAO();
		$user = new User("userName","","userPass","","","","","","","", 1);
		$dao->registerUser($user);
	    $userName = "userName";
	    $pass = "userPass";
	    $c = new LoginController();
	    $res = $c->login($userName, $pass);
        if($res == -1) {
	        echo "$res==-1";
        }
    }

	 public function testInvalidLogIn() {
		$dao = new UserDAO();
		$user = new User("userName","","userPass","","","","","","","", 1);
		$dao->registerUser($user);
	    $userName = "afgsfdge";
	    $pass = "adfgsdfg";
	    $c = new LoginController();
	    $res = $c->login($userName, $pass);
        if($res != -1) {
	        echo "$res!=-1";
        }
    }

	public function testLogOut() {
	    $s = new SessionController();
		$id = getUID();
		$c = new LogoutController();
	    $res = $c->logout();
        if($s->isLoggedIn()) {
	        echo "User wasn't logged out...";
        }
    }
}

?>