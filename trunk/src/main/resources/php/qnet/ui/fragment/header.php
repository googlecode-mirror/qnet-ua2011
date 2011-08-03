<?php
    require_once dirname(__FILE__) . '\..\..\util.php';
    require_controller("headerController");
    use Qnet\Controller\HeaderController;
    $header = new HeaderController();

    echo '<div id="header">
        <div id="menu">
            <ul>
                <li><a href="viewprofile.php">Home</a></li>
                <li><a href="viewprofile.php">Profile</a></li>';
                echo '<li><a href="newquery.php">Create Poll</a></li>'; echo'
                <li><a href="listqueries.php">Answer Polls</a></li>
                <li><a href="bridge.php?target=logoutFrontend">Logout</a></li>
                <li></li>
                <li></li>
                <li></li>                
                <li>Welcome '; echo $header->getSessionName(); echo'.</li>
            </ul>
        </div>
        <!-- end #menu -->
        <div id="search">
            <form method="get" action="listqueries.php">
                <fieldset>
                    <input type="text" class="inputs"name="searchQuery" id="searchQuery" size="15" width="80px"/>
                    <input  class="searchButton"  type="submit" value="Search Query"/>
                </fieldset>
            </form>
	        <form method="post" action="bridge.php?target=search/searchUserController">
                <fieldset>
                    <input  type="text" class="inputs" name="ajaxUser" id="searchUser" size="15" width="80px"/>
                    <input class="searchButton" type="submit" value="Search User"/>
                </fieldset>
            </form>
        </div>
        <!-- end #search -->
    </div>
    <div id="logo">
        <h1><a href="viewprofile.php">Qnet </a></h1>
        <p><em>Your polling social network...</em></p>
    </div>
    <!-- end #logo -->
    <hr/>
';?>