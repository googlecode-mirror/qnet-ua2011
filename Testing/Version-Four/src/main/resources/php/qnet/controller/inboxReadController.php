<?php

namespace Qnet\Controller;

require_once dirname(__FILE__) . '\..\util.php';
require_dao('messageDAO');
require_dao('userDAO');
use Qnet\Dao\MessageDAO;
use Qnet\Dao\UserDAO;


$dao = new MessageDAO();
$udao = new UserDAO();

class InboxReadController
{

    private $mdao;
    private $udao;

    private $mix = -1;

    private $mid;
    private $message;

    function __construct()
    {
        $this->uid = /*getUID();*/
                getUsername();
        $this->mdao = new MessageDAO();
        $this->udao = new UserDAO();

        $this->message = $this->mdao->getMessage($_GET['messageid']);
        $this->mdao->markAsRead($_GET['messageid']);
        $this->udao->selectUserById($this->message['from']);
        /*        $this->message = $query['title'];
      $this->quid = $query['uid'];
      $this->questions = $this->qdao->getQuestionsByQueryId($this->qid);
      $this->questionIx = -1;*/
    }


    public function getTitle()
    {
        return $this->message['title'];
    }

    public function getFrom()
    {
        $this->udao = new UserDAO();
        $name = $this->udao->selectUserById($this->message['from'])->getName();
        $lastname = $this->udao->selectUserById($this->message['from'])->getLastName();

        return $name." ".$lastname;
    }

    public function getContent()
    {
        return $this->message['content'];
    }


}

?>