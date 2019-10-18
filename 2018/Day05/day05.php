#!/usr/bin/php
<?php

function filereader($infile){
//Function that returns the contents of a file and stores it line by line in an array
$array = array();
$handle = fopen($infile, "r") or die ("Unable to open the requested File");
$line = fgets($handle);
fclose($handle);
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

function part01_1($array)
{
    $foundCase = TRUE;
    echo count($array) . "\n";
    $foundCases = 0;
    foreach ($array as $key => $item) {
        if (array_key_exists($key, $array)) {
            if ($key === 0) {
                continue;
            }
            if (!array_key_exists($key - 1, $array)) {
                continue;
            }
            if (isEqual($array[$key - 1], $array[$key])) {
                unset($array[$key], $array[$key - 1]);
                $foundCases += 1;
            }
            else {
                if ($foundCases < 1) {
                    $foundCases = FALSE;
                }
                else {
                    $foundCases = TRUE;
                }
            }
        }
        else {
            break;
        }
    }
    $array = array_values($array);
    echo count($array) . "\n";
    if (!$foundCases) {
        part01($array);
    }
    part01($array);
    return count($array);
}

function part01($string){
    $prestring = "";
    $returnstring = $string;
    for ($i = 0 ;$i<26; $i+=1 ){
        $letters[] = chr(-159+$i).chr(833+$i);
        $letters[] = chr(833+$i).chr(-159+$i);



    }
    while(TRUE){
        $returnstring = str_replace($letters,"",$returnstring);
        if ($prestring === $returnstring){
            break;
        }else{
            $prestring = $returnstring;
        }
    }
    return strlen($returnstring);
}
function part02(){}



for ($i=0;$i<100;$i+=1){
    echo (part01(filereader('input.txt')))."\n";
}
