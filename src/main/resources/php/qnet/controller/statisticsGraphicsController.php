<?php

namespace Qnet\Controller;
require_once dirname(__FILE__) . '\..\util.php';
require_dao('queryDAO');
require_dao('userDAO');
require_dao('answersDAO');
require_dao('statisticsDAO');
require_model('User');
use Qnet\Dao\QueryDAO;
use Qnet\Dao\UserDAO;
use Qnet\Dao\AnswersDAO;
use Qnet\Dao\StatisticsDAO;
use Qnet\Model\User;

class StatisticsGraphicsController {

    private $udao;
    private $adao;
    private $qdao;
    private $sdao;

    private $cardinality;
    private $varAxisMap;
    private $qid;

    private $drawable = true;

    private $series;

    function __construct() {
        $this->udao = new UserDAO();
        $this->qdao = new QueryDAO();
        $this->sdao = new StatisticsDAO();
        $this->adao = new AnswersDAO();
    }

    function computeStatistic($sid) {
        $this->sdao->setCurrentStatistic($sid);
        $this->computeVarsCardinality();
        $this->mapVarsToAxises();

        if(!$this->drawable) { return; }

        $this->qid = $this->sdao->getQid();
        $answers = $this->adao->selectAnswersByQueryId($this->qid);
        $classified = array();

        foreach($answers as $ix => $aid) {
            $classified[$ix] = array();
            for($var = 0; $var < $this->varsCount(); $var++) {
                $classified[$ix][$var] = $this->classify($aid, $var);
            }
        }

        $totals = $this->computeTotals($classified);
        $this->toPercentages($totals, count($answers));
        $this->generateSeries($totals);
    }

    private function generateSeries($totals) {
        $zCount = $this->hasZ() ? $this->cardinality[$this->varAxisMap['z']] : 1;
        $xCount = $this->hasX() ?
                $this->cardinality[$this->varAxisMap['x']] :
                $this->cardinality[$this->varAxisMap['u']] * $this->cardinality[$this->varAxisMap['v']];

        $this->series = array();
        for($z = 0; $z < $zCount; $z++) {
            $this->series[$z] = array();
            for($x = 0; $x < $xCount; $x++) {
                $val = $this->getSeriesValue($z, $x, $totals);
                $lx = $this->getLabelForX($x);
                $this->series[$z][$lx] = $val;
            }
        }
    }

    private function getLabelForX($x){
        if($this->hasX()) {
            $var = $this->varAxisMap['x'];
            return $this->getVarLabel($var, $x);
        } else {
            $u = $this->varAxisMap['u'];
            $v = $this->varAxisMap['v'];
            $ul = $this->getVarLabel($u, floor($x / $this->cardinality[$v]));
            $vl = $this->getVarLabel($v, $x % $this->cardinality[$v]);
            return $ul . "/" . $vl;
        }
    }

    private function getVarLabel($var, $x) {
        if($this->sdao->getVarType($var) == "uVar") {
            $varValue = $this->sdao->getVarValue($var);
            return User::propertyValueAt($varValue, $x);
        } else {
            $qid = $this->sdao->getVarValue($var);
            return $this->adao->getOptionName($qid, $x + 1);
        }
    }

    private function getSeriesValue($z, $x, $totals) {
        switch ($this->varsCount()) {
            case 1: // X, !Z // => $z = 0
                return $totals[$x];
            case 2:
                if($this->hasX()) { // X, Z
                    $zero = $this->varAxisMap['x'] == 0 ? $x : $z;
                    $one = $this->varAxisMap['z'] == 0 ? $x : $z;
                    return $totals[$zero][$one];
                } else { // !X, !Z // => $z = 0
                    $v = $this->varAxisMap['v'];
                    $uIx = floor($x / $this->cardinality[$v]);
                    $vIx = $x % $this->cardinality[$v];
                    $zero = $this->varAxisMap['u'] == 0 ? $uIx : $vIx;
                    $one = $this->varAxisMap['u'] == 1 ? $uIx : $vIx;
                    return $totals[$zero][$one];
                }
            case 3: // !X, Z
                $v = $this->varAxisMap['v'];
                $uIx = floor($x / $this->cardinality[$v]);
                $vIx = $x % $this->cardinality[$v];
                $zero = $this->varAxisMap['u'] < $this->varAxisMap['v'] ? $uIx : $vIx;
                $one = $this->varAxisMap['u'] > $this->varAxisMap['v'] ? $uIx : $vIx;
                switch ($this->varAxisMap['z']) {
                    case 0: return $totals[$z][$zero][$one];
                    case 1: return $totals[$zero][$z][$one];
                    case 2: return $totals[$zero][$one][$z];
                }
        }
    }

    public function getData($series) {
        if($series >= count($this->series)) {
            return '';
        } else {
            return $this->series[$series];
        }
    }

    public function isDrawable() {
        return $this->drawable;
    }

    private function computeVarsCardinality() {
        $this->cardinality = array();
        $vars = $this->sdao->getVarsQty();
        for($i = 0; $i < $vars; $i++) {
            $cardinality = 0;
            if($this->sdao->getVarType($i) == "uVar") {
                $cardinality = User::getPropertyCardinality($this->sdao->getVarValue($i));
            } else if($this->sdao->getVarType($i) == "qVar") {
                $cardinality = $this->computeQVarCardinality($this->sdao->getVarValue($i));
            }
            $this->cardinality[$i] = $cardinality;
        }
    }

    private function classify($aid, $var) {
        if($this->sdao->getVarType($var) == "uVar"){
            $uid = $this->adao->getUserByAnswersId($aid);
            $user = $this->udao->selectUserById($uid);
            $varValue = $this->sdao->getVarValue($var);
            return User::indexOfUserValue($varValue, $user);
        } else {
            $qid = $this->sdao->getVarValue($var);
            $qmap = $this->adao->getOptionsMap($qid);
            $ansOpt = $this->adao->getAswersOptionsMap($aid);
            foreach($qmap as $oid => $number) {
                foreach($ansOpt as $ansOid) {
                    if($oid == $ansOid) {
                        return $number - 1;
                    }
                }
            }
        }
    }

    public function getLegend($series) {
        $zLegend = $this->legendFor($this->varAxisMap['z']);
        return $zLegend[$series];
    }

    public function legendFor($var) {
        if($this->sdao->getVarType($var) == "uVar") {
	        return User::propertyValues($this->sdao->getVarValue($var));
        } else if($this->sdao->getVarType($var) == "qVar") {
            return $this->adao->getOptionNames($this->sdao->getVarValue($var));
        }
    }

    private function computeQVarCardinality($qid) {
        return count($this->qdao->getOptionsByQuestionId($qid));
    }

    private function mapVarsToAxises() {
        $this->drawable = true;
        $this->varAxisMap = array(); // U x V | Z // U x V en el eje X, los valores, en el eje Y.
        if($this->varsCount() > 1) {
            $minCard = $this->cardinality[0];
            $minAxis = 0;
            for($i = 1; $i < count($this->cardinality); $i++) {
                if($this->cardinality[$i] < $minCard) {
                    $minCard = $this->cardinality[$i];
                    $minAxis = $i;
                }
            }

            if($this->varsCount() > 2) {
                if($minCard > 5) {
                    $this->drawable = false;
                    return;
                }
                $this->varAxisMap['z'] = $minAxis;
                $this->varAxisMap['u'] = $minAxis != 0 ? 0 : 2;
                $this->varAxisMap['v'] = $minAxis != 1 ? 1 : 2;
            } else {
                if($minCard > 5) {
                    $this->varAxisMap['u'] = $minAxis;
                    $this->varAxisMap['v'] = $minAxis == 0 ? 1 : 0;
                } else {
                    $this->varAxisMap['z'] = $minAxis;
                    $this->varAxisMap['x'] = $minAxis == 0 ? 1 : 0;
                }
            }
        } else {
            $this->varAxisMap['x'] = 0;
        }
    }

    private function varsCount() {
        return count($this->cardinality);
    }

    private function hasX() { // or has U and V.
        return array_key_exists('x', $this->varAxisMap);
    }

    public function hasZ() { // or not.
        return array_key_exists('z', $this->varAxisMap);
    }

    private function computeTotals($classified) {
        $totals = array();
        for($i = 0; $i < $this->cardinality[0]; $i++) {
            if($this->varsCount() > 1) {
                $totals[$i] = array();
                for($j = 0; $j < $this->cardinality[1]; $j++) {
                    if($this->varsCount() > 2) {
                        $totals[$i][$j] = array();
                        for($k = 0; $k < $this->cardinality[2]; $k++) {
                            $totals[$i][$j][$k] = 0;
                        }
                    } else {
                        $totals[$i][$j] =  0;
                    }
                }
            } else {
                $totals[$i] =  0;
            }
        }

        foreach(array_values($classified) as $map) { //$var => $opt
            switch ($this->varsCount()) {
                case 1:
                    $totals[$map[0]]++;
                    break;
                case 2:
                    $totals[$map[0]][$map[1]]++;
                    break;
                case 3:
                    $totals[$map[0]][$map[1]][$map[2]]++;
                    break;
            }
        }

        return $totals;
    }

    private function toPercentages($totals, $count) {
        for($i = 0; $i < $this->cardinality[0]; $i++) {
            if($this->varsCount() > 1) {
                for($j = 0; $j < $this->cardinality[1]; $j++) {
                    if($this->varsCount() > 2) {
                        for($k = 0; $k < $this->cardinality[2]; $k++) {
                            $totals[$i][$j][$k] = number_format($totals[$i][$j][$k] / $count, 2);
                        }
                    } else {
                        $totals[$i][$j] = number_format($totals[$i][$j] / $count, 2);
                    }
                }
            } else {
                $totals[$i] = number_format($totals[$i] / $count, 2);
            }
        }
    }
}
