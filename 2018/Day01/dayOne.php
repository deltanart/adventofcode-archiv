#!/usr/bin/php
<?php
#########################################################################################
function filereader($inputfile){
    //Function that returns the contents of a file and stores it line by line in an array
    $array = array();
    $handle = fopen($inputfile, "r") or die ("Unable to open the requested File");
    while ($line = fgets($handle)){
        array_push($array, $line);
    }
    fclose($handle);
    return $array;
}

function returnDoubleValues($array){
    //function that returns the first occurrences of the second time the sum occurs by summing up the values of the array
    $frequencySum = 0;
    $seen = array(0);
    while (True){
        foreach ($array as $value) {
            $frequencySum += (int)$value;
            if (in_array($frequencySum, $seen)){
                return $frequencySum;
                break 2;
            }
            $seen[] = $frequencySum;
        }
    }
}
#########################################################################################

$result = 0;
$found = 0;
$frequencies = filereader("input.txt");
$result = array_sum($frequencies);
echo "\nSum: ".$result."<br><br>";
$result = returnDoubleValues($frequencies);
echo "\nFirst Sum that occurs a second time:".$result."\n";

