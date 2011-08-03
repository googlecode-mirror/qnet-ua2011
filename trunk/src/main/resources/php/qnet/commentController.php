<?php

namespace Qnet\Controller;
    require_once dirname(__FILE__) . '\..\util.php';
    require_dao('commentDAO');
    use Qnet\Dao\CommentDAO;

    $dao = new CommentDAO();
    $dao->saveComment($_POST['qId'], getUID(), $_POST['comment']);

    header("Location: /Qnet/target/classes/php/qnet/ui/viewprofile.php");

    ?>