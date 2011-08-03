<?php

require_once dirname(__FILE__) . '\src\main\resources\php\qnet\util.php';
require_db();

use Qnet\dao\DBConnector;


$connector = new DBConnector();
$connection = $connector->createConnection();


$phpdate = date_create("last Wednesday"); //'10 April 2010'

function getNextDate($phpdate) {
	$phpdate->add(new DateInterval("PT6H15M"));
	return date('Y-m-d H:i:s', $phpdate->getTimestamp());
}


// Inser users

function insertUser($id, $name, $lastName, $password, $alive,
                $dateOfBirth,$gender,$maritalSt,$studies,$institution,$location,$religion,$photo) {
    $user = "INSERT INTO users (id,name,lastName,password,alive) VALUES ($id,'$name','$lastName','$password',$alive);";
    mysql_query($user) or die ("Error in query: $user. " . mysql_error());
    $userinfo = "INSERT INTO userinfo (FK_users, dateOfBirth, gender, maritalSt, studies, InstitutionName, currentLocation, religion, photo)
    VALUE ($id, '$dateOfBirth','$gender','$maritalSt','$studies','$institution','$location','$religion', '$photo');";
    mysql_query($userinfo) or die ("Error in query: $userinfo. " . mysql_error());
}

insertUser(1, 'Daniel', 'Gimenez', 'dg', 1, '14-11-1940','Male', 'Single', 'University', 'UA', 'Argentina', 'Catholic', 'img08');
insertUser(2, 'Tomas', 'Alabes', 'ta', 1, '15-11-1945','Female', 'Single', 'University', 'UA', 'Argentina', 'Musulman', 'img08');
insertUser(3, 'Mariano', 'Claveria', 'mc', 1, '16-11-1988','Male', 'Single', 'University', 'UA', 'Argentina', 'Musulman', 'img08');
insertUser(4, 'Agustin', 'Miura', 'am', 1, '17-11-2002','Female', 'Single', 'University', 'UA', 'Argentina', 'Catholic', 'img08');
insertUser(5, 'Daniel', 'Grane', 'dag', 1, '20-11-1990','Male', 'Single', 'University', 'UA', 'Argentina', 'Catholic', 'img08');

// Insert query

$dates = array(getNextDate($phpdate), getNextDate($phpdate), getNextDate($phpdate), getNextDate($phpdate));

insertQuery(1, 'Chocolate', 1, $dates[2]);
    insertAnswer(1,1,2);
    insertAnswer(2,1,3);
    insertAnswer(3,1,4);
    insertAnswer(4,1,5);
    insertQuestion(1, 'Do you like milka?', 1);
        insertOption(1,'Yes',1,1);
            insertAnsOpt(1,1,1);
            insertAnsOpt(2,3,1);
            insertAnsOpt(7,4,1);
        insertOption(2,'No',2,1);
            insertAnsOpt(3,2,2);
    insertQuestion(2, 'How much do you like kinder eggs?', 1);
        insertOption(3,'Lot',1,2);
            insertAnsOpt(4,1,3);
            insertAnsOpt(5,3,3);
            insertAnsOpt(8,4,3);
        insertOption(4,'Medium',2,2);
            insertAnsOpt(6,2,4);
        insertOption(5,'Low',3,2);

	insertSegment('GENDER', 0, 1);
	insertSegment('AGE', 0, 1);
	insertSegment('AGE', 1, 1);

// Insert statistic

insertStatistic(1,'Interesting 2D...',1,1, getNextDate($phpdate));
insertUVar(1,1,'RELIGION',0);
insertQVar(1,1,1,1);

insertStatistic(2,'Interesting 3D...',1,1, $dates[0]);
insertUVar(2,2,'GENDER',0);
insertQVar(2,2,1,1);
insertQVar(3,2,2,2);

insertStatistic(3,'Not so interesting (1D)...',1,1, $dates[3]);
insertUVar(3,3,'AGE',0);

insertTracking(1,2,true, $dates[1]);
insertTracking(1,3,false, getNextDate($phpdate));
insertTracking(2,1,true, getNextDate($phpdate));
insertTracking(2,3,false, getNextDate($phpdate));
insertTracking(3,4,true, getNextDate($phpdate));
insertTracking(4,5,true, getNextDate($phpdate));
insertTracking(5,4,true, getNextDate($phpdate));

function insertStatistic($id,$title,$uid,$qid, $date) {
    $queries = "INSERT INTO statistics (id,title, FK_users, FK_queries, date) VALUES ($id, '$title', $uid, $qid, '$date');";
    mysql_query($queries) or die ("Error in query: $queries. " . mysql_error());
}

function insertUVar($id,$sid,$property,$var) {
    $queries = "INSERT INTO user_variable (id,FK_statistics, property, var) VALUES ($id, $sid, '$property', $var);";
    mysql_query($queries) or die ("Error in query: $queries. " . mysql_error());
}

function insertQVar($id,$sid,$qid,$var) {
    $queries = "INSERT INTO question_variable (id,FK_statistics, FK_question, var) VALUES ($id, $sid,$qid, $var);";
    mysql_query($queries) or die ("Error in query: $queries. " . mysql_error());
}

function insertQuery($id, $title, $uid, $date) {
    $queries = "INSERT INTO queries (id,title, FK_users, date) VALUES ($id, '$title', $uid, '$date');";
    mysql_query($queries) or die ("Error in query: $queries. " . mysql_error());
}

function insertQuestion($id, $text, $qid) {
    $question = "INSERT INTO question (id,text, FK_queries) VALUES ($id, '$text', $qid);";
    mysql_query($question) or die ("Error in query: $question. " . mysql_error());
}

function insertOption($id, $text, $number, $qid) {
    $qoption = "INSERT INTO qoption (id,text, number, FK_question) VALUES ($id,'$text',$number, $qid);";
    mysql_query($qoption) or die ("Error in query: $qoption. " . mysql_error());
}

// Insert answers and qanswer_qoption

function insertAnswer($id,$qid,$uid) {
    $qanswer = "INSERT INTO qanswer (id,FK_queries, FK_users) VALUES ($id,$qid,$uid);";
    mysql_query($qanswer) or die ("Error in query: $qanswer. " . mysql_error());
}
function insertAnsOpt($id,$aid,$oid) {
    $qanswer_qoption = "INSERT INTO qanswer_qoption (id,FK_qanswer, FK_qoption) VALUES ($id,$aid, $oid);";
    mysql_query($qanswer_qoption) or die ("Error in query: $qanswer_qoption. " . mysql_error());
}

function insertTracking($followingId, $followerId, $approved, $date){
	$track = "INSERT INTO trackings (followedId, followerId,approved, date) VALUES ($followingId,$followerId,".($approved?1:0).", '$date');";
    mysql_query($track) or die ("Error in query: $track. " . mysql_error());
}

function insertSegment($property, $value, $qid){
	$track = "INSERT INTO qsegment (FK_queries, property, value) VALUES ('$qid', '$property', '$value')";
    mysql_query($track) or die ("Error in query: $track. " . mysql_error());
}

mysql_close($connection);

echo 'OK';

?>