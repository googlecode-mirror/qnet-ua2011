<?php
namespace Qnet\Controller;
require_once dirname(__FILE__) . '\..\util.php';

require_controller("sessionController");
use Qnet\Controller\SessionController;

class LogoutController{

	public function logout(){
		$s = new SessionController();
		$s->clearUID();
	}

}


?>