<?php include "fragment/head.php"; ?>
<body>
<div id="wrapper">
    <?php include "fragment/header.php"; ?>

    <div id="qbox" class="qbox" style="display: none;">
        <fieldset>
            <div>
                <label for="questionnameX">Question:</label>
                <input type="text" name="questionnameX" id="questionnameX"/>
            </div>

            <div>
                <label for="answersX">Answers:</label>
                <select name="answersX" id="answersX">
                    <option value="yesno">Yes - No</option>
                    <option value="lml">Lot - Medium - Low</option>
                    <option value="mf">Male - Female</option>
                    <option value="please">Yes please! - No thanks!</option>
                </select></div>
        </fieldset>
    </div>

    <?php
        require_once dirname(__FILE__) . '\..\util.php';
        require_controller('answers\answerquerycontroller');
        use Qnet\Controller\AnswerQueryController;
        $controller = new AnswerQueryController();
    ?>

    <div id="page">
        <div id="content">
            <div class="post">
                <?php echo '<h2 class="title">'.$controller->getQueryName().'</h2>';
                    if($_GET['commit']=='ok') {
                        echo '<p>Your answer has been registered. <a href="viewprofile.php?uid='.$controller->getOwnerUid().'">Go to results!</a><p>';
                    }
                ?>
                <div class="entry">
                    <form action="bridge.php?target=answers/answercommitcontroller" method="POST">
                    <input type="hidden" name="qid" value=<?php echo $_GET['qid']; ?> id="uid">
                    <?php
                    while($controller->hasMoreQuestions()) {
                        $controller->nextQuestion();
                        echo '<div>
                            <label  class="mylabelstyle" for="question'.$controller->getQuestionId().'">'.$controller->getQuestionName().'</label>
                            <select name="question'.$controller->getQuestionId().'" id="question'.$controller->getQuestionId().'">';
                        while($controller->hasMoreOptions()) {
                            $controller->nextOption();
                            echo '<option value="'.$controller->getOptionId().'">'.$controller->getOptionText().'</option>';
                        }
                        echo '</select>
                            </div>';
                    }
                    if($_GET['commit']=='ok') {
                        echo '<input   type="submit" class="button2" value="Register" disabled="disabled"/>';
                    } else {
                        echo '<input type="submit"  class="button2" value="Register"/>';
                    }
                    ?>
                    </form>
                </div>
            </div>
        </div>
        <?php include "fragment/sidebar.php"; ?>
        <div style="clear: both;">&nbsp;</div>
    </div>
    <?php include "fragment/footer.php"; ?>
</div>
</body>
</html>