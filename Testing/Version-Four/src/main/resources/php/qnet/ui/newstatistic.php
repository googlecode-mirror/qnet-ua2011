<?php include "fragment/head.php";?>
<body>
<div id="wrapper">
    <?php include "fragment/header.php"; ?>
    <?php
        require_once dirname(__FILE__) . '\..\util.php';
        require_controller('answers\answerquerycontroller');
	    require_model('User');
        use Qnet\Controller\AnswerQueryController;
	    use Qnet\Model\User;
        $controller = new AnswerQueryController;
    ?>

    <div id="page">
        <div id="content">
            <div class="post">
                <h2 class="title">Generate online statistics!</h2>
                <div class="entry">

                <?php
                    if($_GET['commit']=='ok') {
                        echo
                        '<p>Congratulations! Your statistic has been published.<p>';
                    }
                ?>

                    <p>
                    <form action="bridge.php?target=staticcommitcontroller" method="POST">
                        <input type="hidden" name="qid" value=<?php echo $_GET['qid']; ?> id="qid">
                        <fieldset>
                            <legend>Statistic information</legend>
                            <label for="queryname">Title</label><input type="text" name="queryname" id="queryname"/>
                        </fieldset>
                        <fieldset id="boxesTarget">
                            <legend>Variables</legend>
                        <?php
                            for($i = 1; $i <= 3; $i++) {
                        ?>
                            <label for="var<?php echo $i;?>">Variable <?php echo $i;?>:</label>
                            <select name="var<?php echo $i;?>" id="var<?php echo $i;?>">
                                <?php
                                    if($i != 1) {
                                        echo '<option value="NONE">--------</option>';
                                    }
                                    while($controller->hasMoreQuestions()) {
                                        $controller->moveNext();
                                        echo '<option value="'.$controller->getQuestionId().'">'.$controller->getQuestionName().'</option>';
                                    }
                                    $controller->backToStart();
	                                User::printPropertiesOptions();
                                ?>
                            </select>
                            <br/>
                        <?php
                            }
                        ?>
                        </fieldset>
                        <input type="submit" class="button2" value="Publicar"/>
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