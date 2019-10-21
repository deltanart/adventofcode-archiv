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

function absoluteValue($integer){
    if (is_int($integer)){
        if ($integer < 0){
            return $integer *(-1);
        }else{
            return $integer;
        }
    }
    return "Fatal Error: The value is not in Integer in the absoluteValue-Function\n";

}


function cityMetric($ArrayPoint_A, $ArrayPoint_B){
    $delta = absoluteValue($ArrayPoint_A[0] - $ArrayPoint_B[0]) + absoluteValue($ArrayPoint_A[1] - $ArrayPoint_B[1]);
    return $delta;
}
//print_r(filereader("testInput.txt"));









//*******  TESTS ******

/**
 * @return array
 * the array contains a string of each test case and a bool of the testpass;
 */
function testAbsuluteValue(){
    $tests = array();
    if (absoluteValue(0) === 0){$tests[] = "Test01: TRUE\n";}else{$tests[] ="Test01: FALSE\n";}
    if (absoluteValue(-0) === 0){$tests[] = "Test02: TRUE\n";}else{$tests[] ="Test02: FALSE\n";}
    if (absoluteValue(1) === 1){$tests[] = "Test03: TRUE\n";}else{$tests[] ="Test03: FALSE\n";}
    if (absoluteValue(-1) === 1){$tests[] = "Test04: TRUE\n";}else{$tests[] ="Test04: FALSE\n";}
    if (absoluteValue(-27) === 27){$tests[] = "Test05: TRUE\n";}else{$tests[] ="Test05: FALSE\n";}
    if (absoluteValue(555) === 555){$tests[] = "Test06: TRUE\n";}else{$tests[] ="Test06: FALSE\n";}
    if (absoluteValue(-232) === 232){$tests[] = "Test07: TRUE\n";}else{$tests[] ="Test07: FALSE\n";}
    if (absoluteValue("Test") === "Fatal Error: The value is not in Integer in the absoluteValue-Function\n"){$tests[] = "Test08: TRUE\n";}else{$tests[] ="Test08: FALSE\n";}


    return $tests;
}


function test_cityMetric(){

}