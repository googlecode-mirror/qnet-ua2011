<?php
/**
 * Created by IntelliJ IDEA.
 * User: Tomi
 * Date: 23/06/2010
 * Time: 09:16:54
 */
namespace Qnet\Controller;
require_once dirname(__FILE__) . '\..\util.php';
require_dao('QueryDAO');
require_controller('listqueriescontroller');
use Qnet\Dao\QueryDAO;
use Qnet\Controller\ListQueriesController;

class SearchController {

  private $result;

  public function searchQuery($queryTitle){
	  $dao = new QueryDAO();
	  $queryId = $dao->getQueryIdByQueryTitle($queryTitle);
	  if($queryId != -1){
		$this->result = $dao->getQueryById($queryId);
	  }else{
		$this->result = -1;
	  }

	  $uid = getUID();
	  $udao = new UserDAO();
	  $this->result = ListQueriesController::filterQueries($this->result, $udao->selectUserById($uid));

  }

    public function hasResults() {
        return $this->result != -1;
    }

    public function getTitle() {
        return $this->result['title'];
    }

    public function getUid() {
        return $this->result['uid'];
    }
}
//Para eliminar usuario.
//"SELECT user_id, username FROM mismatch_user WHERE username = '$user_username' AND " ."password = $user_password)";