<?php

//$data=$_POST;

$arrayList=[];

$sequence=[];

$initial_state=[];

$solution_step=[];

$initial_pos = array(
    array($data['01'], $data['02'], $data['03']),
    array($data['11'], $data['12'], $data['13']),
    array($data['21'], $data['22'], $data['23'])
);

for ($i=0; $i<3 ; $i++){
    for ($j=0; $j<3 ;$j++){
        $initial_state[]=$initial_pos[$i][$j];
    }
}

$arrayList[]=$initial_pos;

$goal_pos = array(
    array($data['71'], $data['72'], $data['73']),
    array($data['81'], $data['82'], $data['83']),
    array($data['91'], $data['92'], $data['93'])
);

$arrayGoal=[];

for ($i=0; $i<3 ; $i++){
    for ($j=0; $j<3 ;$j++){
        $arrayGoal[]=$goal_pos[$i][$j];
    }
}

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

    for ($i=0; $i < 3; $i++){
        for ($j=0; $j<3 ; $j++){
            $arrayParent[]=$parent[$i][$j];
        }
    }

    $arrayParent=implode("",$arrayParent);

    for ($i=0; $i < 3; $i++){
        for ($j=0; $j<3 ; $j++){
            $arrayChild[]=$child[$i][$j];
        }
    }

    $arrayChild=implode("",$arrayChild);

    $GLOBALS['sequence'][$arrayChild]=$arrayParent;

}

function getParent($arrayChild){
    $sequence=$GLOBALS['sequence'];
    $path=$sequence[$arrayChild];
    return $path;
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

        $check=checkRepeat($newMove);

        if ($check == false){
            setParent($current_state,$newMove);
            $moves[]=$newMove;
        }

    }
    if (canMove($i, $j, $i-1, $j, $current_state)){

        $newMove=moveBlank($i, $j, $i-1, $j, $current_state);

        $check=checkRepeat($newMove);
        if ($check == false){

            setParent($current_state,$newMove);
            $moves[]=$newMove;
        }
    }
    if (canMove($i, $j, $i, $j+1, $current_state)){

        $newMove=moveBlank($i, $j, $i, $j+1, $current_state);

        $check=checkRepeat($newMove);
        if ($check == false){

            setParent($current_state,$newMove);
            $moves[]=$newMove;
        }
    }
    if (canMove($i, $j, $i, $j-1, $current_state)){

        $newMove=moveBlank($i, $j, $i, $j-1, $current_state);

        $check=checkRepeat($newMove);
        if ($check == false){

            setParent($current_state,$newMove);
            $moves[]=$newMove;
        }
    }

    return $moves;

}

$start_time = (double)microtime();

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
        print("Solution found in $i steps<br>");
        print("Unopened Nodes left in the Que=" . $node->count() . "<br>");

        //solution path
        for ($i=0; $i < 3; $i++){
            for ($j=0; $j<3 ; $j++){
                $arrayChild[]=$current_state[$i][$j];
            }
        }
        $initial=implode("",$GLOBALS['initial_state']);

        $arrayChild=implode("",$arrayChild);

        $solution_step[]=$arrayGoal;

        $parent=getParent($arrayChild);
        $parent1=str_split($parent);

        $solution_step[]=$parent1;

        while (true){
            /** @var TYPE_NAME $exception */
            try{
                if ($parent == $initial){
                    break;
                }
                else{
                    $parent=getParent($parent);
                    $parent1=str_split($parent);

                    $solution_step[]=$parent1;
                }
            }catch (Exception $e){
                echo $e;
                break;
            }
        }

        $stepcnt=0;
        foreach ($solution_step as $step){
            $stepcnt++;
        }

        for ($i=$stepcnt-1; $i >= 0; $i--){
            //var_dump($solution_step[$i]);
            //echo "<br>";
            if ($stepcnt-1>$i){ ?>
                <img style="height: 250px; width: 300px;"
                                 src="token_icon_like_download_arrow_by_madddreamer-d3bhsjc.png" alt="arrow-down">
            <?php }
            echo "<table>";
            for ($j=0; $j < 10; $j++){
                if ($j>=0 && $j<=2){
                    if ($j==0){
                        echo "<tr>";
                    }
                    echo "<td>".$solution_step[$i][$j]."</td>";
                    if ($j==2){
                        echo "</tr>";
                    }
                }

                if ($j>=3 && $j<=5){
                    if ($j==3){
                        echo "<tr>";
                    }
                    echo "<td>".$solution_step[$i][$j]."</td>";
                    if ($j==5){
                        echo "</tr>";
                    }
                }

                if ($j>=6 && $j<=8){
                    if ($j==6){
                        echo "<tr>";
                    }
                    echo "<td>".$solution_step[$i][$j]."</td>";
                    if ($j==8){
                        echo "</tr>";
                    }
                }
            }
            echo "</table>";
        }

        break;
    }

    $moves= possibleMoves($current_state);

    foreach ($moves as $move){

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