<?php

class Solver {
    var $pos;
    var $sequence;
    var $depth;
    //var $arrayList=[];

    function  initialization($current_pos) {
        $this->pos = $current_pos;
        $this->sequence = array();
        $this->depth=1;
        //$this->arrayList[]=$current_pos;
    }
    function goalTest($goal) {
        if ($this->pos === $goal) {
            return True;
        } else {
            return False;
        }
    }
    function InSequence($pos) {
        for ($i = 0; $i < count($this->sequence); $i++) {
            if ($this->sequence === $pos) {
                return TRUE;
            }
        }
        return FALSE;
    }
    function moveBlank($srcRow, $srcCol, $destRow, $destCol) {
        $newpos = $this->pos;
        $tmp = $newpos[$destRow][$destCol];
        $newpos[$destRow][$destCol] = $newpos[$srcRow][$srcCol];
        $newpos[$srcRow][$srcCol] = $tmp;
        return $newpos;
    }

    function canMove($srcRow, $srcCol, $destRow, $destCol) {
        if ($srcRow < 0 or $srcCol < 0 or $destRow < 0 or $destCol < 0) {
            return FALSE;
        }
        if ($srcRow > 2 or $srcCol > 2 or $destRow > 2 or $destCol > 2) {
            return FALSE;
        }
        return TRUE;
    }
//    function checkRepeat($newPos){
//        $i=0;
//        foreach ($this->arrayList as $array){
//            if ($array == $newPos){
//                $i=1;
//            }
//        }
//        if ($i == 0){
//            $this->arrayList[]=$newPos;
//        }
//
//        if ($i == 0){
//            return false;
//        }
//        elseif ($i == 1){
//            return true;
//        }
//    }
    function checkMove($srcRow, $srcCol, $destRow, $destCol, & $Moves) {
        if ($this->canMove($srcRow, $srcCol, $destRow, $destCol)) {
            $newpos = $this->moveBlank($srcRow, $srcCol, $destRow, $destCol);
            if (!$this->InSequence($newpos)) {
                //$repeat= $this->checkRepeat($newpos);
                //if ($repeat == false){
                    $newMove = new Solver();
                    $newMove->initialization($newpos);
                    $newMove->sequence = array_merge($this->sequence);
                    $newMove->sequence[] = $newpos;
                    $Moves[] = $newMove;
                //}
            }
        }
    }

    function possibleMoves() {
        $Moves = array();
        for ($i = 0; $i < 3; $i++) {
            for ($j = 0; $j < 3; $j++) {
                if ($this->pos[$i][$j] == 0) {
                    break 2;
                }
            }
        }
        $this->checkMove($i, $j, $i - 1, $j, $Moves);
        $this->checkMove($i, $j, $i + 1, $j, $Moves);
        $this->checkMove($i, $j, $i, $j - 1, $Moves);
        $this->checkMove($i, $j, $i, $j + 1, $Moves);
        return $Moves;
    }


//    function printSequence() {
//        for ($i = 0; $i < count($this->sequence); $i++) {
//            print ("Step $i −−−−>> <br> ");
//            $this->printPos($this->sequence[$i]);
//            print("<br>");
//        }
//    }
//    function printPos($pos) {
//        for ($i = 0; $i < 3; $i++) {
//            for ($j = 0; $j < 3; $j++) {
//                print(" " . $pos[$i][$j] . " ");
//            }
//            print("<br>");
//        }
//    }

}

?>
