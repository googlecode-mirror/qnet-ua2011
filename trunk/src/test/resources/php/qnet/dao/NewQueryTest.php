<?php
namespace Qnet\Test;
/**
 * Created by IntelliJ IDEA.
 * User: Daniel
 * Date: 12/05/2010
 * Time: 21:37:10
 * To change this template use File | Settings | File Templates.
 */
namespace Qnet\Dao;

require_once dirname(__FILE__) . '\..\util.php';
require_dao('queryDAO');
require_dao('createQueryDAO');
require_dao('answersDAO');
use Qnet\Dao\QueryDAO;
use Qnet\Dao\AnswersDAO;
use Qnet\Dao\CreateQueryDAO;

$test = new NewQueryTest();
$test->testQueryDao();

class NewQueryTest {

    private $connector;
    private $connection;

    public function testQueryDao() {

        // Use Query DAO to insert a new query.
        $dao = new CreateQueryDAO();
        if($dao == null) {
            echo "dao is null";
        }

        $dao->initTransaction();
        $queryID = $dao->persistNewQuery('title', 1);
        if($queryID == null) {
            echo "queryID is null";
        }

        $dao->persistQuestion('text');
        $dao->persistAnswer('q0', 0);
        $dao->persistAnswer('q1', 1);
        $dao->persistAnswer('q2', 2);

        $dao->endTransaction();

        // Check DB contains new query with correct values.

        $this->initDBConnection();

        $result = $this->doAssertedQuery('SELECT * FROM queries WHERE id='.$queryID, 1);
        $row = mysql_fetch_assoc($result);
        if('title' != $row['title']) {
            echo "title is wrong";
        }
        mysql_free_result($result);

        $result = $this->doAssertedQuery('SELECT * FROM question WHERE FK_queries='.$queryID, 1);
        $row = mysql_fetch_assoc($result);
        if('text' != $row['text']) {
            echo "text is wrong";
        }
        $questionID = $row['id'];
        mysql_free_result($result);

        $result = $this->doAssertedQuery('SELECT * FROM qoption WHERE FK_question='.$questionID, 3);
        $answers = array();
        for($i = 0; $i < 3; $i++) {
            $row = mysql_fetch_assoc($result);
            $answers[$i] = $row['id'];
            if('q'.$i != $row['text']) {
                echo 'q' . $i . " not equals " . $row['text'];
            }
            if($i != $row['number']) {
                echo $i . " not equals " . $row['number'];
            }
        }
        mysql_free_result($result);

        $this->closeDBConnection();

        // Delete query using Query DAO
        $dao->deleteQueryByID($queryID);

        $this->initDBConnection();

        // Verify querry has been deleted
        $result = $this->doAssertedQuery('SELECT * FROM queries WHERE id='.$queryID, 0);
        mysql_free_result($result);

        $this->closeDBConnection();
    }

    private function initDBConnection() {
        if($this->connector == null) {
             $this->connector = new DBConnector();
             $this->connection = $this->connector->createConnection();
        }
    }

    private function closeDBConnection() {
        if($this->connector != null) {
            mysql_close($this->connection);
            $this->connector = null;
        }
    }

    private function doAssertedQuery($query, $expected_rows) {
        $result = mysql_query($query);
        if($result == FALSE) {
            echo "Error in query: $query. ";
        }
        if($expected_rows != mysql_num_rows($result)) {
            echo "Unexpected number of rows in query: $query. ";
        }
        return $result;
    }
}