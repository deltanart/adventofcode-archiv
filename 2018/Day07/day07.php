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

    return findStart($array,0);
}

function findStart($array, $n){

    if ($n > count($array)-1){
        exit("\nEnd of Array\n");
    }
    for ($list = 0; $list < count($array); ++$list){
        if ($array[$n][0] === $array[$list][1]){
            findStart($array, $n+1);
        }
    }
    $start = array_search($array[$n][0],$array[$n]);
    $ende = findEnd($array, $start);
    return $ende;
}

function findEnd($array, $start){
    for ($searchIndex = 0; $searchIndex < count($array); ++$searchIndex){
        $num = array_search($array[$start][1], $array[$searchIndex]);
        if ($num==0){
            findEnd($array, $num);
        }

    }

    return $array[$start][0];
}

function testD7part01(){
    if (D7part01(filereader("testInput.txt")) === "CABDFE"){
        echo "Testdata: OKAY\nStarting with the Dataset: ";
        print_r(D7part01(filereader("testInput.txt")));
    }else{
        echo "Test Failed!\n";
        print_r(D7part01(filereader("testInput.txt")));
        echo "\n";
    }
}
testD7part01();