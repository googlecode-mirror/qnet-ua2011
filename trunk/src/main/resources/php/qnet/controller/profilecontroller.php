<?php

namespace Qnet\Controller;
require_once dirname(__FILE__) . '\..\util.php';
require_dao('queryDAO');
require_dao('userDAO');
require_dao('answersDAO');
require_dao('commentDAO');
require_dao('statisticsDAO');
require_dao('trackingsDAO');
require_controller('listqueriescontroller');
use Qnet\Dao\QueryDAO;
use Qnet\Dao\UserDAO;
use Qnet\Dao\AnswersDAO;
use Qnet\Dao\CommentDAO;
use Qnet\Dao\StatisticsDAO;
use Qnet\Dao\TrackingsDAO;
use Qnet\Controller\ListQueriesController;

class ProfileController {

    private $udao;
    private $adao;
    private $qdao;
	private $sdao;
	private $cdao;
	private $tdao;

	private $queries;
    private $filteredQueries;
	private $statistics;
	private $questions;
	private $comments;
	private $trackingNotifications;
	private $followingsNotifications;

	private $queryIx = -1;
	private $statisticIx = -1;
	private $statisticId;
	private $queryId;
	private $questionIx = -1;
	private $questionId;
	private $commentIx = -1;
	private $commentId;
	private $trackingNotificationsIx = -1;
	private $followingsNotificationsIx = -1;

	private $queriesDates;
    private $statisticsDates;

	private $currentFollowingNotification;
	private $currentTrackingNotification;

	private $hasAnswers = false;

	private $theuid;
	private $theuser;

	private $orderedElements;
	private $orderedElementsIx = 0;

	function __construct() {
        $this->udao = new UserDAO();

        $this->theuid = $_GET['uid'];
        if(!empty($this->theuid)) {
            $this->theuser = $this->udao->selectUserById($this->theuid);
            if(!$this->theuser) {
                $this->theuid = null;
            } else {
                $ownProfile = $this->theuid == getUID();
            }
        }
        if(empty($this->theuid)) {
            $this->theuid = getUID();
            $this->theuser = $this->udao->selectUserById($this->theuid);
            $ownProfile = true;
        }
        
        $this->qdao = new QueryDAO();
        $queriesDateStructure = $this->qdao->getQueriesByUserId($this->theuid);
        $this->queries = $queriesDateStructure[0];
        $loggedUser = $this->udao->selectUserById(getUID());
        $this->filteredQueries = array_keys(ListQueriesController::filterQueries($this->queries, $loggedUser));
        $this->queriesDates = array_values($queriesDateStructure[1]);
        $this->sdao = new StatisticsDAO();
        $statisticDateStructure = $this->sdao->getStatisticsByUserId($this->theuid);
        $this->statistics = $statisticDateStructure[0];
        $this->statisticsDates = array_values($statisticDateStructure[1]);
        $this->adao = new AnswersDAO();
        $this->cdao = new CommentDAO();
        if($ownProfile) {
		    $this->tdao = new TrackingsDAO();
    		$this->trackingNotifications = $this->tdao->getNotificationsByUserId($this->theuid);
			$this->initFollowingNotifications();
        } else {
            $this->trackingNotifications = array();
            $this->followingsNotifications = array();
        }
		$this->createOrderedElementsList();
    }

	private function initFollowingNotifications(){
		$this->followingsNotifications = array();
		$followed = $this->tdao->getFollowed($this->theuid);
		$i = 0;
		foreach (array_keys($followed) as $key){
			$queries = $this->qdao->getQueriesByUserId($key);
			$queriesDates = array_values($queries[1]);
			$queries = $queries[0];
			$queriesKeys = array_keys($queries);
			$stats = $this->sdao->getStatisticsByUserId($key);
			$statsDates = array_values($stats[1]);
			$stats = $stats[0];
			$statsKeys = array_keys($stats);
			for($j=0; $j < count($queries); $j++){
				$aux = "q" . $queriesKeys[$j];
				$date = $queriesDates[$j];
				$this->followingsNotifications[$i++] = array($key, $aux, $date);
			}
			for($j=0; $j < count($stats); $j++){
				$aux = "s" . $statsKeys[$j];
				$date = $statsDates[$j];
				$this->followingsNotifications[$i++] = array($key, $aux, $date);
			}
		}
		$this->followingsNotifications = $this->array_sort_by_date($this->followingsNotifications);
	}

	private function array_sort_by_date($array)
	{
		$on = 2;
		$new_array = array();
		$sortable_array = array();

		if (count($array) > 0) {
			foreach ($array as $k => $v) {
				if (is_array($v)) {
					foreach ($v as $k2 => $v2) {
						if ($k2 == $on) {
							$sortable_array[$k] = $v2;
						}
					}
				} else {
					$sortable_array[$k] = $v;
				}
			}

			arsort($sortable_array);

            $ix = 0;
			foreach ($sortable_array as $k => $v) {
				$new_array[$ix++] = $array[$k];
			}
		}

		return $new_array;
	}


	public function getUserName() {
        return $this->theuser->getName();
    }

    public function getUserPhoto() {
        return $this->theuser->getPhoto();
    }

    public function hasMoreStatistics() {
        return $this->statisticIx+1 < count($this->statistics);
    }

    public function hasMoreQueries() {
        return $this->queryIx+1 < count($this->queries);
    }

    public function nextStatistic() {
        $this->statisticIx++;
        $ids = array_keys($this->statistics);
        $this->statisticId = $ids[$this->statisticIx];
        $this->sdao->setCurrentStatistic($this->statisticId);

        $this->queryId = $this->sdao->getQid();
        $this->hasAnswers = count($this->adao->selectAnswersByQueryId($this->queryId)) != 0;
    }

    public function nextQuery() {
        $this->queryIx++;
        $ids = array_keys($this->queries);
        $this->queryId = $ids[$this->queryIx];

        $this->questions = $this->qdao->getQuestionsByQueryId($this->queryId);
        $this->questionIx = -1;

        $this->comments = $this->cdao->loadAllComments($this->queryId);
        $this->commentIx = -1;

        $this->hasAnswers = count($this->adao->selectAnswersByQueryId($this->queryId)) != 0;
    }

	private function getQueryTimestamp() {
		 return $this->qdao->getQueryDateById($this->queryId);
	}

    public function getQueryName() {
        return $this->queries[$this->queryId];
    }

    public function getStatisticName() {
        return $this->statistics[$this->statisticId];
    }

	private function getStatisticTimestamp() {
		return $this->statisticsDates[$this->statisticIx];
	}

    public function getQueryDate() {
        return $this->queriesDates[$this->queryIx];
    }

    public function hasMoreQuestions() {
        return $this->questionIx+1 < count($this->questions);
    }

    public function hasMoreComments() {
        return $this->commentIx+1 < count($this->comments[0]);
    }

    public function nextQuestion() {
        $this->questionIx++;
        $ids = array_keys($this->questions);
        $this->questionId = $ids[$this->questionIx];
    }

    public function nextComment() {
        $this->commentIx++;
        $ids = array_keys($this->comments[0]);
        $this->commentId = $ids[$this->commentIx];
    }

    public function getCommentText() {
        return $this->comments[0][$this->commentId];
    }

	public function getCommentUser() {
		return $this->comments[2][$this->commentId];
	}

	public function getCommentDate() {
		return $this->comments[1][$this->commentId];
	}

    public function getQuestionName() {
        return $this->questions[$this->questionId];
    }

    public function getQuestionImage() {
        return '../images/qchart.php?qid='.$this->questionId.'&title='.$this->getQuestionName();
    }

    public function getStatisticImage() {
        return '../images/schart.php?sid='.$this->statisticId.'&size=small';
    }

    public function getBigStatisticImage() {
        return '../images/schart.php?sid='.$this->statisticId.'&size=big';
    }

    public function queryHasAnswers() {
        return $this->hasAnswers;
    }

    public function getQid() {
        return $this->queryId;
	}

    public function userApplies() {
        return array_search($this->queryId, $this->filteredQueries) !== false;
    }

	public function hasMoreTrackingNotifications() {
        return $this->trackingNotificationsIx+1 < count($this->trackingNotifications);
    }

	public function getCurrentTrackingTimestamp() {
		return $this->currentTrackingNotification[3];
	}

	public function getCurrentTrackingNotification() {
		return $this->currentTrackingNotification;
	}

	public function getCurrentFollowingsTimestamp() {
		return $this->currentFollowingNotification[3];
	}

	public function getCurrentFollowingsNotification() {
		return $this->currentFollowingNotification;
	}

    public function nextTrackingNotification() {
        $this->trackingNotificationsIx++;
        //2: notificationId
		$ids = array_keys($this->trackingNotifications);
		$notifs = array_values($this->trackingNotifications);
		$notif = $notifs[$this->trackingNotificationsIx];
        //0: Name + LastName
		$follower = $this->udao->selectUserById($notif[0]);
        //1: approved?
        $this->currentTrackingNotification = array($follower->getName()." ".$follower->getLastName(),$notif[1], $ids[$this->trackingNotificationsIx], $notif[2]);
	    return $this->currentTrackingNotification;
    }

	public function hasMoreFollowingsNotifications() {
		return $this->followingsNotificationsIx+1 < count($this->followingsNotifications);
    }

	public function nextFollowingsNotification() {
        $this->followingsNotificationsIx++;
		$notif = $this->followingsNotifications[$this->followingsNotificationsIx];
		$uids = $notif[0];
		$sqids = $notif[1];
		$follower = $this->udao->selectUserById($uids);
		$title = "";
        $timestamp = 0;
		if (substr($sqids[0],0,1) == 'q'){
			$query = $this->qdao->getQueryTitleById(substr($sqids,1));
			$title = "q" . $query[0];
		}else{
			$statisticTitle = $this->sdao->getStatisticTitleById(substr($sqids,1));
			$title = "s" . $statisticTitle;
		}
        $timestamp = $notif[2];
        $this->currentFollowingNotification = array($follower->getId(), $follower->getName()." ".$follower->getLastName(), $title, $timestamp);
		return $this->currentFollowingNotification;
    }

	public function hasMoreElements() {
		return $this->orderedElementsIx < count($this->orderedElements);
	}

	public function getNextElementUI() {
		return $this->orderedElements[$this->orderedElementsIx++];
	}

	private function createOrderedElementsList() {
		$uis = array("queries", "statistics", "notifications", "alerts");
		$this->orderedElements = array();

		//$timestamps = array(false, false, false, false);
		$timestamps = array(-1, -1, -1, -1);
		$pendingCount = 0;
		if($this->hasMoreQueries()) {
			$this->nextQuery();
			$timestamps[0] = strtotime($this->getQueryTimestamp());
			$pendingCount++;
		}
		if($this->hasMoreStatistics()) {
			$this->nextStatistic();
			$timestamps[1] = strtotime($this->getStatisticTimestamp());
			$pendingCount++;
		}
		if($this->hasMoreTrackingNotifications()) {
			$this->nextTrackingNotification();
			$timestamps[2] = strtotime($this->getCurrentTrackingTimestamp());
			$pendingCount++;
		}
		if($this->hasMoreFollowingsNotifications()) {
			$this->nextFollowingsNotification();
			$timestamps[3] = strtotime($this->getCurrentFollowingsTimestamp());
			$pendingCount++;
		}

		while($pendingCount > 0) {
			$used = array_search(max($timestamps), $timestamps);
			$pendingCount--;
			$this->orderedElements[$this->orderedElementsIx++] = $uis[$used];
			$timestamps[$used] = -1;
			switch($used) {
				case 0:
					if($this->hasMoreQueries()) {
						$this->nextQuery();
						$timestamps[0] = strtotime($this->getQueryTimestamp());
						$pendingCount++;
					}
			        break;
				case 1:
					if($this->hasMoreStatistics()) {
						$this->nextStatistic();
						$timestamps[1] = strtotime($this->getStatisticTimestamp());
						$pendingCount++;
					}
			        break;
				case 2:
					if($this->hasMoreTrackingNotifications()) {
						$this->nextTrackingNotification();
						$timestamps[2] = strtotime($this->getCurrentTrackingTimestamp());
						$pendingCount++;
					}
			        break;
				case 3:
					if($this->hasMoreFollowingsNotifications()) {
						$this->nextFollowingsNotification();
						$timestamps[3] = strtotime($this->getCurrentFollowingsTimestamp());
						$pendingCount++;
					}
			        break;
			}
		}

		$this->orderedElementsIx = 0;
		$this->queryIx = -1;
		$this->statisticIx = -1;
		$this->trackingNotificationsIx = -1;
		$this->followingsNotificationsIx = -1;
		$this->questionIx = -1;
		$this->commentIx = -1;
	}

	public function getStatisticDate() {
		return $this->statisticsDates[$this->statisticIx];
	}
}
?>