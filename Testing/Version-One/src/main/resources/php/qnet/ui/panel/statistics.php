<?php
        $controller->nextStatistic();
        echo '<div class="post">
            <h2 class="title">'.$controller->getStatisticName().'</h2>
            <p class="date">'.$controller->getStatisticDate().'</p>
            <div class="entry">';
        if($controller->queryHasAnswers()) {
            echo '<p><a href="'.$controller->getBigStatisticImage().'"><img src="'.$controller->getStatisticImage().'" alt="'.$controller->getStatisticName().'"></a><p>';
        } else {
            echo "<p>Statistic's query has not been answered yet.</p>";
        }
        echo '</div></div>';
    
?>
