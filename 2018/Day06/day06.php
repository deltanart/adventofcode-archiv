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
    foreach ($array as $key =>$item) {
        $array[$key] = explode(", ", $item);
    }
    return $array;
}

function absoluteValue($integer){
    //why not use abs()? ;D
    return abs($integer);
}

/**
 * @param $ArrayPoint_A
 * @param $ArrayPoint_B
 * @return int
 */
function cityMetric($ArrayPoint_A, $ArrayPoint_B){
    if (!is_int($ArrayPoint_A[0])){$ArrayPoint_A[0] = (int)$ArrayPoint_A[0];}
    if (!is_int($ArrayPoint_A[1])){$ArrayPoint_A[1] = (int)$ArrayPoint_A[1];}
    if (!is_int($ArrayPoint_B[0])){$ArrayPoint_B[0] = (int)$ArrayPoint_B[0];}
    if (!is_int($ArrayPoint_B[1])){$ArrayPoint_B[1] = (int)$ArrayPoint_B[1];}
    if (is_int($ArrayPoint_A[0]) && is_int($ArrayPoint_A[1]) && is_int($ArrayPoint_B[0])&& is_int($ArrayPoint_B[1])){
        $delta = absoluteValue($ArrayPoint_A[0] - $ArrayPoint_B[0]) + absoluteValue($ArrayPoint_A[1] - $ArrayPoint_B[1]);
        return (int)$delta;
    }else{
        exit("One of the Points does contain a non Numeric value\n");
    }

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
        if ($MaxX<(int)$arrayOfValue[0]){
            $MaxX = (int)$arrayOfValue[0];
        }
        if ($MaxY<(int)$arrayOfValue[1]){
            $MaxY = (int)$arrayOfValue[1];
        }
    }
    if ($MaxX % 10 != 0){
        $MaxX += 10-($MaxX % 10);
    }
    if ($MaxY % 10 != 0){
        $MaxY += 10-($MaxY % 10);
    }
    if (is_int($MaxX) && is_int($MaxY)) {
        return array($MaxX, $MaxY);
    }else{
        exit("FOR TESTING ONLY: Got the wrong Grid dimensions\n");
    }
} //looks okay


function Day06_part01($array){
    $gridDim = getGridDimensions($array);
    echo "Grid Dimensions: ";
    print_r($gridDim);
    $grid = array();
    $infinite = array();

    for ($y = 0; $y<(int)$gridDim[1]; $y++){
        for ($x = 0; $x<(int)$gridDim[0]; $x++){
            $closeestDistance = 99999;//high number because we look for the lowest number
            $closeestPoint=99999;//same as above
            foreach ($array as $key=> $item) {
                //checks if we are already on a point. if so write the id here and continue with the code below the foreach
                if ($x === $item[0] && $y === $item[1]){
                    $grid[$x][$y] = $key;
                    break;
                }

                //tests if there are multiple points equally far apart
                if (cityMetric(array($x, $y),$item) == $closeestDistance){
                    $grid[$x][$y] = ".";
                    continue;
                }

                //tests which point is the closest to the current location
                if (cityMetric(array($x, $y), $item)<$closeestDistance){
                    $closeestDistance = cityMetric(array($x, $y), $item);
                    $closeestPoint = $key;
                    $grid[$x][$y] = $closeestPoint;
                }
            }
            if ($x === 0 || $y === 0){
                $infinite[] = $grid[$x][$y];
            }
            if ($x === $gridDim[0]-1 || $y === $gridDim[1]-1){
                $infinite[] = $grid[$x][$y];
            }
        }
    }
    return calcArea($grid, $infinite);
}


function calcArea($array, $infinite){
    $results = array();
    $corners = $infinite;
    print_r($corners);
    foreach ($array as $keyA => $itemX) {
        $partN = array_count_values($itemX);
        foreach ($partN as $key => $item) {
            echo "Key: $key\n";
            if (in_array($key,$corners)){
                continue;
            }elseif(isset($results[$key])){
                $results[$key] += $item;
            }else{
                $results[$key] = $item;
            }

        }
    }
    arsort($results);
    $returnerKey = array_keys($results);
    return $results[$returnerKey[0]];
}




//*******  TESTS  ******

/**
 * @return array
 * the array contains a string of each test case and a bool of the testpass;
 */
function testAbsuluteValue(){
    echo "Testing Absulute Value: ";
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
//print_r(testAbsuluteValue());

function test_cityMetric(){
    echo "Testing City Metric: ";
    if (cityMetric(array(0,1), array(6,-7)) !== 14){echo "Test 01: False\n";}
    if (cityMetric(array(0,1), array(6,7)) !== 12){echo "Test 02: False\n";}
    if (cityMetric(array(0,0), array(6,6)) !== 12){echo "Test 03: False\n";}
    if (cityMetric(array(6,6), array(0,0)) !== 12){echo "Test 04: False\n";}
    echo " done\n";

}
test_cityMetric();

function test_getGridDimensions(){
    echo "Testing getGridDimensions: ";
    if (getGridDimensions(array(array(1,1),array(5,0))) !== array(10,10)){echo "Test01: False\n";}
    if (getGridDimensions(array(array("t","e"),array("x","t"))) !== array(0,0)){echo "Test03: False\n";}
    if (getGridDimensions(array(array(1,1),array(0,0))) !== array(10,10)){echo "Test03: False\n";}
    if (getGridDimensions(array(array(0,0),array(0,0))) !== array(0,0)){echo "Test04: False\n";}
    if (getGridDimensions(array(array(-1,-1),array(1,1))) !== array(10,10)){echo "Test05: False\n";}
    echo " done.\n";
}
test_getGridDimensions();

function test_Day06_part01(){
    if (Day06_part01(filereader("testInput.txt")) === 17){
        echo "Test Input successful. Output of the RawInput: \n";
        print_r(Day06_part01(filereader("input.txt")));
    }else{
        echo "Complete Grid: \n";
        print_r(Day06_part01(filereader("testInput.txt")));
        exit("\nStill stuff to do!\n");
    }
}
test_Day06_part01();