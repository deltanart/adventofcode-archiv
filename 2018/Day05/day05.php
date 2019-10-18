#!/usr/bin/php
<?php

function filereader($infile){
//Function that returns the contents of a file and stores it line by line in an array
$array = array();
$handle = fopen($infile, "r") or die ("Unable to open the requested File");
$line = fgets($handle);
fclose($handle);
$line = str_split($line,1); //line is now an array of each character
return $line;
}

function isEqual($charOne, $charTwo){
    //checks to chars regardles of upper or lower case if there are identical and returns a bool
    $charOne = strtolower($charOne);
    $charTwo = strtolower($charTwo);
    if ($charOne == $charTwo){
        return TRUE;
    }else{ return FALSE;}
}

function part01($array){
    $foundCase = TRUE;
    while($foundCase) {
        $foundCases = 0;
        foreach ($array as $key => $item) {
            if (array_key_exists ($key , $array)){
                if ($key === 0) {
                    continue;
                }
                if (isEqual($array[$key - 1], $array[$key])) {
                    unset($array[$key], $array[$key - 1]);
                    $array = array_values($array);
                    $foundCases += 1;
                }
                else {
                    if ($foundCases<1) {
                        $foundCases = FALSE;
                    }
                }
            }else{
                break;
            }
        }
        if (!$foundCases){
            $foundCase = FALSE;
        }
    }
    return $array;
}
function part02(){}

print_r(part01(filereader('testInput.txt')));