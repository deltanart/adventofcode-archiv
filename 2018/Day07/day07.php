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

/**
 * @param $array
 * @return array
 */
function filterInput($array){
    $filteredInput = array();
    foreach ($array as $key => $item) {
        preg_match_all("/\s\w\s/",$item, $matches);
        $filteredInput[$key] = $matches[0];
    }
    print_r($array);
    print_r( $filteredInput);
}


function D7part01($array){

}

//function that deletes the task from the array on every instance to move on
function deleteTaskFromArray($array, $toDelete){
    array_replace();
    //find every instance of 'toDelete': if @array[k][0] -> delete @array[k] (hole entry)
    // if @array[k][1] -> should not exist but please delete and tell it to the console!
}

//function that finds the next task that has no dependency upfront
function findNextTask(){
//get element @array[k][0] that is not @array[n][1]
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
