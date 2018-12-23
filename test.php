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
//    var_dump($array);
//    echo '<br>';
    if ($array == $b){
        $i=1;
    }
}

if ($i==0){
    $arrayList[]=$b;
}

//echo "<br>final array<br>";
//foreach ($arrayList as $array){
//    var_dump($array);
//    echo '<br>';
//}

$list=[
    "012345678" => "876543210",
    "013245678" => "786543210",
];

$d=[0,1,2,3,4,5,6,7,8];

$e=implode("",$d);

//var_dump($e);

$e=str_split($e);

for ($i=0;$i<9;$i++){
    echo $e[$i];
    echo "<br>";
}