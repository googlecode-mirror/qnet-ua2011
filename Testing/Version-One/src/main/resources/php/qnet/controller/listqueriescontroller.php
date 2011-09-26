<?php

namespace Qnet\Controller;
require_once dirname(__FILE__) . '\..\util.php';
require_dao('queryDAO');
require_dao('userDAO');
require_model('User');
use Qnet\Model\User;
use Qnet\Dao\QueryDAO;
use Qnet\Dao\UserDAO;

class ListQueriesController {

    private $qdao;
    private $uid;

    private $queries;

    private $queryIx = -1;
    private $queryId;

    function __construct() {
        $this->uid = getUID();
        $this->qdao = new QueryDAO();

        $search = $_GET["searchQuery"];
        if(empty($search)) {
            $queriesDateStructure = $this->qdao->getAllQueries();
        } else {
            $queriesDateStructure = $this->qdao->getQueriesByPartialString($search);
        }
		$udao = new UserDAO();
        $this->queries = ListQueriesController::filterQueries($queriesDateStructure[0], $udao->selectUserById($this->uid));
		$this->queriesDates = $queriesDateStructure[1];  
    }

    public function hasMoreQueries() {
        return $this->queryIx+1 < count($this->queries);
    }

    public function nextQuery() {
        $this->queryIx++;
        $ids = array_keys($this->queries);
        $this->queryId = $ids[$this->queryIx];
    }

    public function getQueryLink() {
        return '<a href="answerquery.php?qid='.$this->queryId.'">'.$this->getQueryName().' ('.$this->getQueryDate().')</a>';
    }

    public function getQueryName() {
        return $this->queries[$this->queryId];
    }

    public function getQueryDate() {
        return $this->queriesDates[$this->queryId];
    }

	public function setQueries($queries){
		$this->queries=$queries;
	}

	public static function array_to_comma_string($array) {
		foreach($array as $k => $v) {
			echo $k.'-'.$v.'|';
		}
		echo '\n';
	}

	public static function filterQueries($queries, $user) {
		$result = array();
		foreach($queries as $qid => $title) {
			$qdao = new QueryDAO();
			$segments = $qdao->getSegmentsByQueryId($qid);
			$tristate = User::createPropertyMap(0);
			foreach (array_values($segments) as $segment) {
				$prop = $segment[0];
				$value = $segment[1];
				if($tristate[$prop] != 1) {
					$tristate[$prop] = User::indexOfUserValue($prop, $user) == $value? 1 : -1;
				}
			}
			$applies = true;
			foreach (array_values($tristate) as $value) {
				if($value == -1) {
					$applies = false;
					break;
				}
			}
			if($applies) {
				$result[$qid] = $title;
			}
		}
		return $result;
	}
}
?>