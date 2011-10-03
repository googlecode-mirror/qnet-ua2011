<?php
/**
 * Created by IntelliJ IDEA.
 * User: Mart0
 * Date: 9/5/11
 */
require_once dirname(__FILE__) . '\..\util.php';
require_dao('commentDAO');
use Qnet\Dao\CommentDAO;
$commentDao = new CommentDAO();
$newCommentId = $commentDao->saveComment(1, 1, "'' OR 1");
// with the '' clearly sql inyection
$commentMap = $commentDao->loadAllComments(1);
echo $commentMap;
if ($commentMap[$newCommentId] == "' OR 1") {
    // ALL GOOD
} else {
    echo "SQL Inyection Test Fail";
}

?>