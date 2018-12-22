<?php

$arrayList=[];

$sequence=[];

//functions

function moveBlank($srcRow, $srcCol, $destRow, $destCol, & $pos) {
    $newpos = $pos;
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

function checkRepeat($newPos){
    $allMoves= $GLOBALS['arrayList'];
    $i=0;
    foreach ($allMoves as $move){
        if ($move == $newPos){
            $i=1;
        }
    }
    if ($i == 0){
        $GLOBALS['arrayList'][]=$newPos;
    }

    if ($i == 0){
        return false;
    }
    elseif ($i == 1){
        return true;
    }
}

function setParent($parent,$child){
    $GLOBALS['sequence']["$child"]=$parent;
}

function getParent($child){
    $sequence=$GLOBALS['sequence'];
    return $sequence["$child"];
}

function possibleMoves($current_state) {

    $moves=[];

    $detectBlankSpace = $current_state;
    for ($i = 0; $i < 3; $i++) {
        for ($j = 0; $j < 3; $j++) {
            if ($detectBlankSpace[$i][$j] == 0) {
                break 2;
            }
        }
    }

    if (canMove($i, $j, $i+1, $j, $current_state)){

        $newMove=moveBlank($i, $j, $i+1, $j, $current_state);

        setParent($current_state,$newMove);

        $check=checkRepeat($newMove);
        if ($check == false){
            $moves[]=$newMove;
        }

    }
    if (canMove($i, $j, $i-1, $j, $current_state)){

        $newMove=moveBlank($i, $j, $i-1, $j, $current_state);

        $check=checkRepeat($newMove);
        if ($check == false){
            $moves[]=$newMove;
        }
    }
    if (canMove($i, $j, $i, $j+1, $current_state)){

        $newMove=moveBlank($i, $j, $i, $j+1, $current_state);

        $check=checkRepeat($newMove);
        if ($check == false){
            $moves[]=$newMove;
        }
    }
    if (canMove($i, $j, $i, $j-1, $current_state)){

        $newMove=moveBlank($i, $j, $i, $j-1, $current_state);

        $check=checkRepeat($newMove);
        if ($check == false){
            $moves[]=$newMove;
        }
    }

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

$i=1;

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
        print("<br>Solution found in $i steps<br>");
        print("Unopened Nodes left in the Que=" . $node->count() . "<br>");

        //solution path
        $parent=getParent($current_state);
        echo $parent;

        break;
    }

    $moves= possibleMoves($current_state);

    foreach ($moves as $move){

//        echo "<br>";
//        var_dump($move);
//        echo "<br>";

        $node->enqueue($move);
    }
    $node->rewind();

    $i++;
}

print ("<br>Maximum Memory used " . memory_get_peak_usage());
print ("<br>Current Memory used " . memory_get_usage());
$end_time = (double)microtime();
$time_exec = $end_time - $start_time;
print("<br>Execution time used = " . $time_exec);
echo "<br>";