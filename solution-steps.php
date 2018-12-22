<?php

require_once ('solver.php');

$data=$_POST;
//var_dump($data);

?>
<!DOCTYPE html>
<html>
<head>
    <title>8 puzzle solver</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <style type="text/css">
        body{
            background-color:#43A047;
            font-family:sans-serif;
        }
        td{
            color:#43A047;
            height:100px;
            width:100px;
            padding:12px;
            border: 2px solid #43A047;
            border-radius:5px;
            text-align:center;
            font-size:40px;
        }
        table{
            margin-top:20px;
            margin-bottom:20px;
            background:rgba(1,1,1,0);
            border-radius:5px;
            background:white;
        }
        h1{
            margin:5px;
            text-shadow: -5px 5px 2px rgba(11,11,11,0.5);
            color:white;
            font-weight:bold;
        }
    </style>
</head>
<body>
<center><h1>8 puzzle game</h1></center>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <center>
        <h1>Agent Solution steps</h1>

            <?php

            $start_time = (double)microtime();

            $initial_pos = array(
                array($data['01'], $data['02'], $data['03']),
                array($data['11'], $data['12'], $data['13']),
                array($data['21'], $data['22'], $data['23'])
            );

            //var_dump($initial_pos);

            $goal_pos = array(
                array($data['71'], $data['72'], $data['73']),
                array($data['81'], $data['82'], $data['83']),
                array($data['91'], $data['92'], $data['93'])
            );

            //var_dump($goal_pos);

            $initial_state = new Solver();
            $initial_state->initialization($initial_pos);
            $initial_state->sequence = $initial_pos;
            //$initial_state->arrayList= $initial_pos;

            $nodeQue = new SplQueue();
            $nodeQue->enqueue($initial_state);
            $nodeQue->rewind();
            $i = 1;

            while ($nodeQue->valid()) {
                $i++;
                if ($i % 10000 == 0) {
                    print("$i steps have been finished<br>");
                    print("Unopened Nodes left in the Que = " . $nodeQue->count() . "<br>");
                    $end_time = (double)microtime();
                    $exec_time = $end_time-$start_time;
                    print ("Time executed to $i steps is $end_time <br>");
                }
                $current_state = new Solver();
                $current_state = $nodeQue->dequeue();
                if ($current_state->goalTest($goal_pos) == TRUE) {
                    print("Solution found in $i steps<br>");
                    print("Unopened Nodes left in the Que=" . $nodeQue->count() . "<br>");
                    ?>

                    <table>
                        <tr>
                            <td><?php echo $initial_pos[0][0]; ?></td>
                            <td><?php echo $initial_pos[0][1]; ?></td>
                            <td><?php echo $initial_pos[0][2]; ?></td>
                        </tr>
                        <tr>
                            <td><?php echo $initial_pos[1][0]; ?></td>
                            <td><?php echo $initial_pos[1][1]; ?></td>
                            <td><?php echo $initial_pos[1][2]; ?></td>
                        </tr>
                        <tr>
                            <td><?php echo $initial_pos[2][0]; ?></td>
                            <td><?php echo $initial_pos[2][1]; ?></td>
                            <td><?php echo $initial_pos[2][2]; ?></td>
                        </tr>
                    </table>

                    <?php
                    for ($i = 3; $i < count($current_state->sequence); $i++) {
                            ?>
                            <img style="height: 250px; width: 300px;"
                                 src="token_icon_like_download_arrow_by_madddreamer-d3bhsjc.png" alt="arrow-down">
                            <?php
                        echo "<table>";
                        for ($j = 0; $j < 3; $j++) {
                            echo "<tr>";
                            for ($k = 0; $k < 3; $k++) {
                                if ($j==0){
                                    echo "<td>";
                                    print ($current_state->sequence[$i][$j][$k]);
                                    echo "</td>";
                                }
                                if ($j==1){
                                    echo "<td>";
                                    print ($current_state->sequence[$i][$j][$k]);
                                    echo "</td>";
                                }
                                if ($j==2){
                                    echo "<td>";
                                    print ($current_state->sequence[$i][$j][$k]);
                                    echo "</td>";
                                }
                                //print(" " . $current_state->sequence[$i][$j][$k] . " ");
                            }
                            echo "</tr>";
                        }
                        echo "</table>";
                        echo "<br>";
                    }

                    break;

                }
                $moves = $current_state->possibleMoves();
                foreach ($moves as $move) {
                    var_dump($move);
                    echo "<br>";
                    echo "<br>";
                    $nodeQue->enqueue($move);
                }
                $nodeQue->rewind();
            }


            print ("<br>Maximum Memory used " . memory_get_peak_usage());
            print ("<br>Current Memory used " . memory_get_usage());
            $end_time = (double)microtime();
            $time_exec = $end_time - $start_time;
            print("<br>Execution time used = " . $time_exec);
            echo "<br>";
            echo "<br>";

            ?>
            </center>
        </div>
    </div>
</div>
<center>
    <div class="knk" style="color:white; position:static; font-family:sans-serif; text-decoration:none; bottom:0px;
    right:20px; margin: 20px">
        <h5>Designed with &#9829; by Sayedul sayem</h5>
    </div>
</center>
</body>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js" integrity="sha384-pjaaA8dDz/5BgdFUPX6M/9SUZv4d12SUPF0axWc+VRZkx5xU3daN+lYb49+Ax+Tl" crossorigin="anonymous"></script>

</html>
