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
function inputhandler($RawInput){
    foreach ($RawInput as $line) {
        $line = preg_match_all('/(\d+)/',$line,$temp);
        $returner[] = $temp[0];
    }
    return $returner;
}

function findOverlapPoint($RawArray){
    //return a list of x and y coordinates
    //each pair represents a point that overlaps with any other
    //Input Variables
    foreach ($RawArray as $item) {
        $arrayX[] = $item[1];//Array of all X Values
        $arrayRangeX[] = $item[3];//Array of all ranges for X
        $arrayY[] = $item[2];
        $arrayRangeY[] = $item[4];
    }
    print_r($arrayX);
    //temps
    $foundX = array();
    $foundY = array();
    //Logic
    $indexWhile = 0;
    while ($indexWhile < count($arrayX)){
        for ($innerIndex = 0; $innerIndex<=count($arrayX);$innerIndex+=1){
            if ($arrayX[$indexWhile] > $arrayX[$innerIndex] and $arrayX[$indexWhile]+$arrayRangeX[$indexWhile] < $arrayX[$innerIndex]+$arrayRangeX[$innerIndex]){
                if ($arrayY[$indexWhile] > $arrayY[$innerIndex] and $arrayY[$indexWhile]+$arrayRangeY[$indexWhile] < $arrayY[$innerIndex]+$arrayRangeY[$innerIndex]){
                    $foundX[] = $arrayX[$indexWhile];
                    $foundY[] = $arrayY[$indexWhile];
                }
            }
        }
        $indexWhile+=1;
    }
    print_r($foundX);
    print_r($foundY);



    //prepare Output
    $returnArray = array();
    for ($index = 0; $index <= count($foundX); $index += 1 ){
        $returnArray[] = array($foundX[$index], $foundY[$index]);
    }
    return array();
}

function deleteDoubles($arrayOfAllPoints){
    return array_unique($arrayOfAllPoints);
}

echo findOverlapPoint(inputhandler(filereader("testInput.txt")));