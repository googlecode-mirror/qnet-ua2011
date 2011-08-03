<?php  echo '
        <div id="sidebar">
            <ul>
                <li>';
echo "<h2>" . $header->getUserName();
if($header->canFollow()) {
    echo '<input id="followBtt" type="button"  class="button2" onClick="follow('.$header->getUserID().')" style="font-size: 0.7em;" value="Follow!" /></h2>';
}
echo '</h2><ul>

				<li>
					<img width="120" height="150" src="..'.$header->getUserPhoto().'" alt="photo">
				</li>

</ul>';
echo '

                </li>';


include "following.php";
include "followers.php";

if($isViewProfile && $header->isOwnProfile()) {
    echo '<li>
                    <h2>Account Options</h2>
                    <ul>';
    echo '<li><a href="modifyUser.php">Edit profile</a></li>';
    echo '<li><form enctype="multipart/form-data" action="bridge.php?target=photoController" method="POST">
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