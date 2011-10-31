<?php include "fragment/head.php";?>
<?php


require_model("User");
require_controller('profilecontroller');
require_controller('photoController');
use Qnet\Controller\ProfileController;
use Qnet\Controller\PhotoController;
use Qnet\Model\User;
$photoController=new PhotoController();
$photoPath=$photoController->getPhoto();

?>
<body onload="addqbox()">
<div id="wrapper">
    <?php include "fragment/header.php"; ?>

    <div id="qbox" class="qbox" style="display: none;">
        <fieldset>
            <div>
                <label  class="mylabelstyle" for="questionnameX">Question:</label>
                <input type="text" name="questionnameX" id="questionnameX"/>
            </div>

            <div>
                <label  class="mylabelstyle" for="answersX">Answers:</label>
                <select name="answersX" id="answersX">
                    <option value="yesno">Yes - No</option>
                    <option value="lml">Lot - Medium - Low</option>
                    <option value="mf">Male - Female</option>
                    <option value="please">Yes please! - No thanks!</option>
                </select></div>
        </fieldset>
    </div>

    <div id="filter" class="qbox" style="display: none;">
        <fieldset>
            <div>
                <label  class="mylabelstyle" for="filtercatX">Category:</label>
                <select name="filtercatX" id="filtercatX">
                    <?php User::printPropertiesOptions(); ?>
                </select>
            </div>

            <div>
                <label  class="mylabelstyle" for="filterpopX">Population:</label>
                <select name="filterpopX" id="filterpopX">
                    <?php User::printSimpleOptionsFor(User::$FIRST_PROPERTY); ?>
                </select>
            </div>
        </fieldset>
    </div>

    <div id="page">
        <div id="content">
            <div class="post">
                <h2 class="title">Make your very own online query!</h2>
                <div class="entry">

                <?php
                    if($_GET['commit']=='ok') {
                        echo
                        '<p>Congratulations! Your query has been published.<p>';
                    }
                ?>

                    <p>
                    <form action="bridge.php?target=querycontroller"  id="createQueryForm" method="POST">
                        <input type="hidden" name="qlength" value="0" id="qlength">
                        <input type="hidden" name="filterslength" value="0" id="filterslength">
                        <fieldset>
                            <legend>Query information</legend>
                            <label  class="mylabelstyle" for="queryname">Title</label><input type="text" name="queryname" id="queryname"/>
                        </fieldset>
                        <fieldset id="boxesTarget">
                            <legend>Questions</legend>
                            <input class="summitQuery" type="button" name="addqbox" value="Add Question" onclick="window.addqbox()"/>
                        </fieldset>
                        <fieldset id="filtersTarget">
                            <legend>Filters</legend>
                            <input class="summitQuery" type="button" name="addfilter" value="Add Filter" onclick="window.addfilter()"/>
                            <br/>
                            The query will be targeted to selected population, if any chosen for a specific category.
                            <br/>
                        </fieldset>
                        <input type="submit"  class="button2" value="Publicar"/>
                    </form>
                    </p>
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