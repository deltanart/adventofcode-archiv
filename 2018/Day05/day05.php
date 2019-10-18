#!/usr/bin/php
<?php

/**
 * @param string $infile
 * @return false|string
 */
function filereader($infile){
$line = file_get_contents($infile);
$line = trim($line);
return $line;
}

function isEqual($charOne, $charTwo){
    //checks to chars regardles of upper or lower case if there are identical and returns a bool
    $charOnelower = strtolower($charOne);
    $charTwolower = strtolower($charTwo);
    if ($charOnelower == $charTwolower and $charOne != $charTwo){
        return TRUE;
    }else{ return FALSE;}
}

function part01_1($array)
{
    $array = str_split($array, 1);

    $foundCase = TRUE;
    echo count($array) . "\n";
    $index = 0;
    while ($foundCase) {
        $foundCases = 0;
        foreach ($array as $key => $item) {
            if (!array_key_exists($key, $array)) {continue;}
            if ($key === 0) {continue;}
            if (!array_key_exists($key - 1, $array)) {continue;}

            if (isEqual($array[$key - 1], $array[$key])) {
                unset($array[$key], $array[$key - 1]);
                $foundCases += 1;
            }
        }
        if ($foundCases < 1) {
            $foundCase = FALSE;
            echo "$index\n";
        }
        $index += 1;
        $array = array_values($array);

    }
    echo count($array) . "\n";

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
        if ($prestring == $returnstring){
            break;
        }
        $prestring = $returnstring;

    }
    return strlen($returnstring);
}
function part02($string){

    $returnstring = $string;
    $prestring = "";
    for ($i = 0 ;$i<26; $i+=1 ){
        $letters[chr(-159+$i)] = chr(-159+$i);
        $letterS[chr(833+$i)] = chr(833+$i);
        $Counting[chr(-159+$i)] = 0;
    }
    foreach ($Counting as $key =>$item) {
        $returnstring = str_replace($letterS[strtoupper($key)],"",$returnstring);
        $returnstring = str_replace($letters[$key],"",$returnstring);
        $Counting[$key] = part01($returnstring);
        $returnstring = $string;
    }
    print_r($Counting);

    asort($Counting);
    $get = array_keys($Counting);
    echo $Counting[$get[0]];
}




echo (part01_1(filereader('input.txt')))."\n";

