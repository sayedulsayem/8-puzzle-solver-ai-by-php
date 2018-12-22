<?php

$arrayList=[];

$a=array(
    array(1, 2, 3),
    array(4, 5, 6),
    array(7, 8, 0)
);

$b=array(
    array(2, 1, 3),
    array(4, 5, 6),
    array(7, 8, 0)
);

$c=array(
    array(1, 2, 3),
    array(4, 5, 6),
    array(7, 0, 8)
);

$arrayList[]=$a;
$arrayList[]=$c;

$i=0;
foreach ($arrayList as $array){
    var_dump($array);
    echo '<br>';
    if ($array == $b){
        $i=1;
    }
}

if ($i==0){
    $arrayList[]=$b;
}

echo "<br>final array<br>";
foreach ($arrayList as $array){
    var_dump($array);
    echo '<br>';
}