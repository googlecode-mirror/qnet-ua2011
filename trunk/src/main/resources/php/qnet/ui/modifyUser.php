<?php include "fragment/head.php"; ?>
<body>
<div id="wrapper">
    <?php include "fragment/header.php"; ?>
    <?php
        require_once dirname(__FILE__) . '\..\util.php';
    require_controller("sessionController");
    require_dao('userDAO');
    require_model("User");
    use Qnet\Dao\UserDAO;
    use Qnet\Model\User;
    use Qnet\Controller\SessionController;

    $userDaoInstance = new UserDao();

    $sc = new SessionController();
    $uid = $sc->getUID();
    $userInstance = $userDaoInstance->selectUserById($uid);

    $username = $userInstance->getName();
    $lastName = $userInstance->getLastName();
    $userPassword = $userInstance->getPassword();

    $gender = $userInstance->gender;
    $maritalStatus = $userInstance->maritalSt;
    $studies = $userInstance->studies;
    $institutionName = $userInstance->InstitutionName;
    $country = $userInstance->country;
    $religion = $userInstance->getReligion();
    ?>

    <div id="page">
        <div id="content">
            <div class="post">
                <h2 class="title">Modify your information here please</h2>

                <div class="entry">

                    <form action="bridge.php?target=modifyUserController" method="POST">
                        <fieldset>
                            <legend>Personal information</legend>
                            <div><label for="userName" class="mylabelstyle">Name:</label><input type="text"
                                                                                                name="userName"
                                                                                                id="userName"
                                                                                                value="<?php echo $username; ?>"
                                                                                                required/>
                            </div>
                            <div><label for="userLasName" class="mylabelstyle">Last name:</label><input type="text"
                                                                                                        name="userLastName"
                                                                                                        id="userLasName"
                                                                                                        value="<?php echo $lastName; ?>"
                                                                                                        required/>
                            </div>
                            <div><label for="password" class="mylabelstyle">Password:</label>
                                <input type="password" name="password"
                                       id="password"
                                       value="<?php echo $userPassword; ?>" required/></div>
                            <div><label for="rePassword" class="mylabelstyle">Retype Password:</label>
                                <input type="password"
                                       name="rePassword"
                                       id="rePassword"
                                       value="<?php echo $userPassword; ?>" required/>
                            </div>
                            <div>
                                <?php User::printOptionsFor(User::$GENDER, $gender); ?>
                            </div>
                            <div>
                                <?php User::printOptionsFor(User::$MARITAL_STATUS, $maritalStatus); ?>
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend>Studies</legend>
                            <div>
                                <?php User::printOptionsFor(User::$STUDIES, $studies); ?>
                            </div>
                            <div>
                                <label class="mylabelstyle" for="institutionName">Institution name:</label>
                                <input type="text" name="InstitutionName" id="InstitutionName"
                                       value="<?php echo $institutionName ?>"/>
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend>Other information</legend>
                            <div>
                                <?php User::printOptionsFor(User::$LOCATION, $country); ?>
                            </div>
                            <div>
                                <?php User::printOptionsFor(User::$RELIGION, $religion); ?>
                            </div>
                        </fieldset>
                        <div><input id="submitSignUpButton" type="submit"></div>
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