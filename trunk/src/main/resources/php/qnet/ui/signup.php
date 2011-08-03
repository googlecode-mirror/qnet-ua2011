<?php include "fragment/insecureHead.php";?>
<body>
<div id="wrapper">
	<?php
		require_once dirname(__FILE__) . '\..\util.php';
		require_model("User");
		use Qnet\Model\User;
	?>

    <div id="page">
        <div id="content">
            <div class="post">
                <h2 class="title">Signup and join our community!</h2>

                <div class="entry">
                    <p>
                    <form action="signupFrontend.php" method="POST">
                        <fieldset>
                            <legend>Personal information</legend>
                            <div><label for="userName" class="mylabelstyle">Name:</label><input type="text" name="userName" id="userName"/>
                            </div>
                            <div><label for="userLasName" class="mylabelstyle">Last name:</label><input type="text" name="userLastName"
                                                                                   id="userLasName"/></div>
                            <div><label for="password" class="mylabelstyle">Password:</label><input type="password" name="password"
                                                                               id="password"/></div>
                            <div><label for="rePassword" class="mylabelstyle">Retype Password:</label><input type="password"
                                                                                        name="rePassword"
                                                                                        id="rePassword"/>
                            </div>
                            <div><label class="mylabelstyle">Date of Birth:</label>
                                <select name="year"><?php yearOptions(date('Y')); ?></select>
                                <select name="month"><?php monthOptions(); ?></select>
                                <select name="day"><?php dayOptions(); ?></select>
                            </div>
	                        <div>
		                        <?php User::printOptionsFor(User::$GENDER); ?>
	                        </div>
	                        <div>
		                        <?php User::printOptionsFor(User::$MARITAL_STATUS); ?>
							</div>
	                    </fieldset>
	                    <fieldset>
	                        <legend>Studies</legend>
	                        <div>
		                        <?php User::printOptionsFor(User::$STUDIES); ?>
	                        </div>
	                        <div>
		                        <label class="mylabelstyle" for="institutionName">Institution name:</label>
	                            <input type="text" name="InstitutionName" id="InstitutionName" value="<?php echo $institutionName ?>" />
	                        </div>
	                    </fieldset>
	                    <fieldset>
	                        <legend>Other information</legend>
	                        <div>
		                        <?php User::printOptionsFor(User::$LOCATION); ?>
	                        </div>
	                        <div>
		                        <?php User::printOptionsFor(User::$RELIGION); ?>
	                        </div>
	                    </fieldset>
                        <div><input id="submitSignUpButton" class="summitQuery" type="submit"></div>
                    </form>
                </div>
            </div>
        </div>
    <?php include "fragment/footer.php"; ?>
</div>
</body>
</html>

<?php
function yearOptions($endYear = '', $startYear = '1900') {
    for ($i = $startYear; $i <= $endYear; $i++)
    {
        ($i == date('Y')) ? $selected = ' selected="selected"' : $selected = '';
        echo '<option value="' . $i . '"' . $selected . '>' . $i . '</option>' . "\n";
    }
}

function monthOptions() {
    $months = array(1 => "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");

    foreach ($months as $monthNo => $month)
    {
        ($monthNo == date('n')) ? $selected = ' selected="selected"' : $selected = '';
        echo '<option value="' . $monthNo . '"' . $selected . '>' . $monthNo . ' - ' . $month . '</option>' . "\n";
    }
}

function dayOptions() {
    for ($i = 1; $i <= 31; $i++)
    {
        ($i == date('j')) ? $selected = ' selected="selected"' : $selected = '';
        echo '<option value="' . $i . '"' . $selected . '>' . $i . '</option>' . "\n";
    }
}

?>