#!/usr/bin/php
<?php
function filereader($infile){
    //Function that returns the contents of a file and stores it line by line in an array
    $array = array();
    $handle = fopen($infile, "r") or die ("Unable to open the requested File");
    while ($line = fgets($handle)){
        $array[]= $line;
    }
    fclose($handle);
    return $array;
}


function returnDoubleValues($array){
    //function that returns the first occurrences of the second time the sum occurs by summing up the values of the array
    $array = array_count_values($array);
    if (in_array(2, $array)){
        $returner[0] = 1;
    }else{
        $returner[0] = 0;
    }
    if (in_array(3, $array)){
        $returner[1] = 1;
    }else{
        $returner[1] = 0;
    }

    return $returner;
}

function sumup($array){
    $two = 0;
    $three = 0;
    foreach ($array as $items) {
        $temp = array();
        $intake=str_split($items);
        $temp = returnDoubleValues($intake);
        if ($temp[0] == 1){
            $two += 1;
        }
        if ($temp[1] == 1) {
            $three += 1;
        }

    }
    echo "Two:".$two." Three:".$three." \n";
    return $two*$three;

}

function lvstein($array){
    foreach ($array as $item) {
        foreach ($array as $item2) {
            if (levenshtein($item,$item2) === 1){
                echo $item." & ".$item2;
                break 2;
            }
        }
    }
}

echo sumup(filereader("input.txt"));
lvstein(filereader("input.txt"));