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
    return filterInput($array);
}

/**
 * @param $array
 * @return array
 */
function filterInput($array){
    $filteredInput = array();
    foreach ($array as $key => $item) {
        preg_match_all("/\s\w\s/",$item, $matches);
        $filteredInput[$key] = $matches[0];
    }
    print_r($array);
    print_r( $filteredInput);
}


function D7part01($array){
    $output = "";
    $output .= $parts[] = $start[] = findStart($array,0);
    print_r(findStart($array,0));


    print_r(recursiveTreeData($array, $start));

    print_r($parts);

    return $output;
}
function recursiveTreeData($DataArray,$startKeys){
    $output = "";

    for ($posistionInArray = 0;$posistionInArray<count($DataArray); ++$posistionInArray){
        foreach ($startKeys as $nr => $startKey) {
            $nextKeys[] = array_search($DataArray[$startKeys][1], $DataArray);
            $output .= recursiveTreeData($DataArray, $nextKeys);

        }
    }
    return $output;
}


/**
 * @param $array
 * @param $n
 * @return mixed
 */
function findStart($array, $n){
    if ($n > count($array)-1){
        exit("\nEnd of Array\n");
    }
    for ($list = 0; $list < count($array); ++$list){
        if ($array[$n][0] === $array[$list][1]){
            findStart($array, $n+1);
        }
    }

    $start[] = array_search($array[$n][0],$array[$n]);
    return $start;
}



function testD7part01(){
    if (D7part01(filereader("testInput.txt")) === "CABDFE"){
        echo "Testdata: OKAY\nStarting with the Dataset: ";
        print_r(D7part01(filereader("testInput.txt")));
    }else{
        echo "Test Failed!\n";
        print_r(D7part01(filereader("testInput.txt")));
        echo "\n";
    }
}
testD7part01();
