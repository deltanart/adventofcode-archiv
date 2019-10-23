#!/usr/bin/php
<?php

/**
 * @param $infile
 * @return array
 */

function filereader($infile){
    //Function that returns the contents of a file and stores it line by line in an array
    $array = array();
    $handle = fopen($infile, "r") or die ("Unable to open the requested File");
    while ($line = fgets($handle)){
        $array[]= $line;
    }
    fclose($handle);
    return filterInput($array);
}

function filterInput($array){
    $filteredInput = array();
    foreach ($array as $key => $item) {
        preg_match_all("/\s\w\s/",$item, $matches);
        $filteredInput[$key] = $matches[0];
    }
    return $filteredInput;
}


function D7part01($array){



    return findX($array,0);
}

function findX($array, $n){

    for ($k = 0; $k<count($array); ++$k){
        if ($k === $n){
            continue;
        }
        if ($array[$n][0] == $array[$k][1]){
            findX($array, $k);
        }else{
            return $array[$n][0];
        }
    }

}


function testD7part01(){
    if (D7part01(filereader("testInput.txt")) === "CABDFE"){
        echo "Testdata: OKAY\nStarting with the Dataset: ";
        print_r(D7part01(filereader("testInput.txt")));
    }else{
        echo "Test Failed!\n";
        print_r(D7part01(filereader("testInput.txt")));
    }
}
testD7part01();