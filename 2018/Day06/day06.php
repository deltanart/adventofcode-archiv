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
    $delta = absoluteValue(absoluteValue($ArrayPoint_A[0]) - absoluteValue($ArrayPoint_B[0])) +
        absoluteValue(absoluteValue($ArrayPoint_A[1]) - absoluteValue($ArrayPoint_B[1]));
    return $delta;
}
//print_r(filereader("testInput.txt"));

/**
 * @param $ArrayOfValues
 * @return array
 */
function getGridDimensions($ArrayOfValues){
    $MaxX = 0;
    $MaxY = 0;
    foreach ($ArrayOfValues as$key => $arrayOfValue) {
        if ($MaxX<$arrayOfValue[0]){
            $MaxX = $arrayOfValue[0];
        }
        if ($MaxY<$arrayOfValue[1]){
            $MaxY = $arrayOfValue[1];
        }
    }
    return array($MaxX, $MaxY);
}

print_r(getGridDimensions(filereader("testInput.txt"))); //[0] => 8 ; [1] =>9

function Day06_part01($array){
    $gridDim = getGridDimensions($array);
    $grid = array();
    for ($y = 0; $y<=$gridDim[1]; $y++){
        for ($x = 0; $x<=$gridDim[0]; $x++){
            foreach ($array as $key=> $item) {
                if ($x == $item[0] && $y == $item[1]){
                    $grid[$x][$y] = $key;
                    continue 2;
                }
            }
            $grid[$x][$y] = ".";
        }
    }

    print_r($grid);
}

Day06_part01(filereader("testInput.txt"));




//*******  TESTS  ******

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
//testAbsuluteValue();

function test_cityMetric(){
    if (cityMetric(array(0,1), array(6,-7)) === 12){echo "Test 01: True\n";}else{echo "Test 01: False\n";}
}
//test_cityMetric();

function test_getGridDimensions(){
    if (getGridDimensions(array(array(1,1),array(5,0))) === array(5,1)){echo "Test01: True\n";}else{echo "Test01: False\n";}
}
//test_getGridDimensions();