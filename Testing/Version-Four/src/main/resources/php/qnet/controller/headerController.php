<?php

namespace Qnet\Controller;
require_once dirname(__FILE__) . '\..\util.php';
require_dao('trackingsDAO');
require_dao('userDAO');
use Qnet\Dao\UserDAO;
use Qnet\Dao\TrackingsDAO;

class HeaderController {

    private $sessionName;
    private $ownProfile;
    private $theuid;
    private $theuser;

    private $tdao;

    function __construct() {
        $this->udao = new UserDAO();

        $this->theuid = $_GET['uid'];
        if(!empty($this->theuid)) {
            $this->theuser = $this->udao->selectUserById($this->theuid);
            if(!$this->theuser) {
                $this->theuid = null;
            } else {
                $this->ownProfile = $this->theuid == getUID();
            }
        }
        if(empty($this->theuid)) {
            $this->theuid = getUID();
            $this->theuser = $this->udao->selectUserById($this->theuid);
            $this->ownProfile = true;
        }

        $this->username = $this->theuser->getName();
        $this->photo = $this->theuser->getPhoto();

        if(!$this->ownProfile) {
            $uid = getUID();
            $user = $this->udao->selectUserById($uid);
            $this->sessionName =  $user->getName();
        } else {
            $this->sessionName = $this->username;
        }

        $this->tdao = new TrackingsDAO();
    }

    public function getUserID() {
        return $this->theuid;
    }

    public function getOwnID() {
        return getUID();
    }

    public function canFollow() {
        return !$this->isOwnProfile() && !$this->tdao->userFollows(getUID(), $this->getUserID());
        return getUID();
    }

    public function isEmpty($arr) {
        return empty($arr);
    }

    public function isOwnProfile() {
        return $this->ownProfile;
    }

    public function getUserName() {
        return $this->theuser->getName();
    }

    public function getSessionName() {
        return $this->sessionName;
    }

    public function getUserPhoto() {
        return $this->theuser->getPhoto();
    }

    public function getFollowers() {
        return $this->tdao->getFollowers($this->theuid);
    }

    public function getFollowing() {
        return $this->tdao->getFollowed($this->theuid);
    }
}
?>