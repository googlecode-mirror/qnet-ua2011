<?php
if(!$header->isEmpty($header->getFollowing())) {
    echo '<li id="followingLI">
    <h2>Following <input type="button"  class="button2" onClick="refreshFollowing()" style="font-size: 0.7em;" value="refresh" /></h2>
    Some people who ' . ($header->isOwnProfile() ? 'you are following' : 'is followed by ' . $header->getUserName()) . ':<br/>
    <ul>';
foreach($header->getFollowing() as $fUID=>$fNAME) {
    echo "<li><a href='viewprofile.php?uid=$fUID'>$fNAME</a>";
    if($header->isOwnProfile()) {
        echo '<a href="bridge.php?followed=' . $fUID . "&follower=" . $header->getOwnID() . '&target=followremovecontroller" style="margin-left: 15px; font-size: 10px">(X)<a/>';
    }
    echo "</li>";
}
    echo '</ul>
</li>';
}
?>