<?php

namespace Qnet\Controller;

require_once dirname(__FILE__) . '\..\util.php';
require_dao('messageDAO');
use Qnet\Dao\MessageDAO;

$dao = new MessageDAO();

class InboxController {

    private $mdao;
    private $mix = -1;

    private $mid;
    private $message;
    private $messages;

    function __construct() {
        $this->uid = getUID();//getUsername();
        $this->mdao = new MessageDAO();
        $this->messages = $this->mdao->getMessages($this->uid);
/*        $this->message = $query['title'];
        $this->quid = $query['uid'];
        $this->questions = $this->qdao->getQuestionsByQueryId($this->qid);
        $this->questionIx = -1;*/
    }

    public function hasMoreMessages() {
        return $this->mix+1 < count($this->messages);
    }

    public function nextMessage() {
        $this->mix++;
        $this->message = $this->messages[$this->mix];
    }

    public function getMid() {
        return $this->message['id'];
    }

    public function getTitle() {
        return $this->message['title'];
    }

    public function isRead() {
        return $this->message['read'] == 1;
    }
}
?>