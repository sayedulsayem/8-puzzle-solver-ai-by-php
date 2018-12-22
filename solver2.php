<?php

$arrayList=[];


//functions

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

function possibleMoves($current_state) {
    $moves = $current_state;
    for ($i = 0; $i < 3; $i++) {
        for ($j = 0; $j < 3; $j++) {
            if ($moves[$i][$j] == 0) {
                break 2;
            }
        }
    }
    checkMove($i, $j, $i - 1, $j, $moves);
    checkMove($i, $j, $i + 1, $j, $moves);
    checkMove($i, $j, $i, $j - 1, $moves);
    checkMove($i, $j, $i, $j + 1, $moves);
    return $moves;
}


$start_time = (double)microtime();

$initial_pos = array(
    array(2, 8, 3),
    array(1, 6, 4),
    array(7, 0, 5)
);

$arrayList[]=$initial_pos;

$goal_pos = array(
    array(1, 2, 3),
    array(8, 0, 4),
    array(7, 6, 5)
);

$node=new SplQueue();
$node->enqueue($initial_pos);
$node->rewind();

$i=0;

while ($node->valid()){
    if ($i % 10000 == 0) {
        print("$i steps have been finished<br>");
        print("Unopened Nodes left in the Que = " . $node->count() . "<br>");
        $end_time = (double)microtime();
        $exec_time = $end_time-$start_time;
        print ("Time executed to $i steps is $end_time <br>");
    }

    $current_state= $node->dequeue();
    if ($current_state == $goal_pos){
        print("Solution found in $i steps<br>");
        print("Unopened Nodes left in the Que=" . $node->count() . "<br>");
        break;
    }

    $moves= possibleMoves($current_state);



    $i++;
}