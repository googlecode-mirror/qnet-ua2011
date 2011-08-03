<?php
if(!$header->isEmpty($header->getFollowers())) {
echo '<li id="followersLI">
    <h2>Followers <input type="button"  class="button2" onClick="refreshFollowers()" style="font-size: 0.7em;" value="refresh" /></h2>
    Some people who follows ' . ($header->isOwnProfile() ? 'you' : $header->getUserName()) . ':<br/>
    <ul>';
foreach($header->getFollowers() as $fUID=>$fNAME) {
    echo "<li><a href='viewprofile.php?uid=$fUID'>$fNAME</a>";
    if($header->isOwnProfile()) {
        echo '<a href="bridge.php?follower=' . $fUID . "&followed=" . $header->getOwnID() . '&target=followremovecontroller" style="margin-left: 15px; font-size: 10px">(X)<a/>';
    }
    echo "</li>";
}
    echo '</ul>
</li>';
}
?>