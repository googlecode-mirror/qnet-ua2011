<?php  echo '
        <div id="sidebar">
            <ul>
                <li>';
echo "<h2>" . $header->getUserName();
if($header->canFollow()) {
    echo '<input id="followBtt" type="button"  class="button2" onClick="follow('.$header->getUserID().')" style="font-size: 0.7em;" value="Follow!" /></h2>';
}
echo "</h2><ul><li><img width=\"120\" height=\"150\" \"src='..".$photoPath."' alt='photo'></li></ul>";
echo '

                </li>';


include "following.php";
include "followers.php";

echo '<li> <a href="followersRanking.php"> View Ranking </a> </li>';

if($header->isOwnProfile()) {
    echo '<li>
                    <h2>Account Options</h2>
                    <ul>';
    echo '<li><a href="modifyUser.php">Edit profile</a></li>';
    echo '<li><form enctype="multipart/form-data" action="../controller/photoController.php?actionId=1" method="POST">
<input type="hidden" name="MAX_FILE_SIZE" value="100000" />
Choose a file to upload: <input name="uploadedfile" type="file" /><br />
<input type="submit" value="Upload File" />
</form>
</li>';
    echo "<li><a href='bridge.php?target=deleteAccount'>Delete account</a>";
    echo '
                    </ul>
                </li>
            </ul>';
}
echo'
</ul></div>
';?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta name="generator" content=
  "HTML Tidy for Linux/x86 (vers 11 February 2007), see www.w3.org" />

  <title></title>
</head>

<body>
</body>
</html>
