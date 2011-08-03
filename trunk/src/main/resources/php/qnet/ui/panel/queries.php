<?php

    $controller->nextQuery();
    echo '<div class="post">
    <h2 class="title">' . $controller->getQueryName() . '</h2>
    <p class="date">' . $controller->getQueryDate() . '</p>
    <div class="entry">';
    if ($controller->queryHasAnswers()) {
        while ($controller->hasMoreQuestions()) {
            $controller->nextQuestion();
            echo '<p><img src="' . $controller->getQuestionImage() . '" alt="' . $controller->getQuestionName() . '"><p>';
        }
    } else {
        echo '<p>Query has not been answered yet.</p>';
    }
    while ($controller->hasMoreComments()) {
        $controller->nextComment();

	echo '<div class="comment"><fieldset>
            <legend>'.$controller->getCommentUser().' ('.$controller->getCommentDate().')</legend>';
            echo '<p class="centerText" >' . $controller->getCommentText() . '<p>';
    echo '</fieldset></div>';

    }
    echo '<div class="toComment" >
        <form action="bridge.php?target=commentController" method="post">
               <fieldset>
                <div>
                    <input type="text" name="comment" id="comment" />
            </div>
              </fieldset>
            <input type="hidden" name="qId" value="' . $controller->getQid() . '">
            <div>
                <input  type="submit"  class="button2" value="Comment">
            </div>
       </form>';
    if($controller->userApplies()) {
        echo '<p><a href="answerquery.php?qid=' . $controller->getQid() . '">Answer this Query</a></p>';
    }
    echo '<p><a href="newstatistic.php?qid=' . $controller->getQid() . '">Create Statistics</a></p>
    </div>';
    echo '</div></div>';

?>