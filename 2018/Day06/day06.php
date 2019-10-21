#!/usr/bin/php
<?php

/**
 * @param string $infile
 * @return false|string
 */
function filereader($infile){
    //Function that returns the contents of a file and stores it line by line in an array
    $array = array();
    $handle = fopen($infile, "r") or die ("Unable to open the requested File");
    while ($line = fgets($handle)){
        $array[]= $line;
    }
    fclose($handle);
    foreach ($array as $key =>$item) {
        $array[$key] = explode(", ", $item);
    }
    return $array;
}



function cityMetric($ArrayPoint_A, $ArrayPoint_B){
    $delta = 0;
}
print_r(filereader("testInput.txt"));