<?php

namespace Qnet\Controller;

require_once dirname(__FILE__) . '\..\util.php';
require_dao('messageDAO');
use Qnet\Dao\MessageDAO;

$dao = new MessageDAO();

class InboxReadController
{

    private $mdao;
    private $mix = -1;

    private $mid;
    private $message;

    function __construct()
    {
        $this->uid = /*getUID();*/
                getUsername();
        $this->mdao = new MessageDAO();
        $this->message = $this->mdao->getMessage($_GET['messageid']);
        $this->mdao->markAsRead($_GET['messageid']);

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
        return $this->message['from'];
    }

    public function getContent()
    {
        return $this->message['content'];
    }


}

?>