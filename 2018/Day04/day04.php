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