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
    print_r($filteredInput);
    return $filteredInput;
}


function D7part01($Tasks){
    $output = "";
    do{
        $CurrentTask = findNextTask($Tasks);
        if ($CurrentTask == ""){continue;}
        $output .= $CurrentTask;
        echo "Output: $output\n";
        $Tasks = deleteTaskFromArray($Tasks,$CurrentTask);
    }while (TRUE);
    return $output;
}

//function that deletes the task from the array on every instance to move on
function deleteTaskFromArray($Tasks, $toDelete){
    foreach ($Tasks as $key => $item) {
        if($item[0] == $toDelete){
            unset($Tasks[$key]);
        }
    }
    //ConsoleOutput:
    echo "Post-Del: ";
    print_r($Tasks);
    echo "\n";

    return $Tasks;

}

function testDeleteTaskFromArray(){
    if (deleteTaskFromArray(array(array("A","B"), array("B", "C")),"A") === array(1=>array("B","C"))){echo "Del Test: True\n";}else{echo "Del Test: False\n";}
}
testDeleteTaskFromArray();


//function that finds the next task that has no dependency upfront
function findNextTask($Tasks){
//get element @array[k][0] that is not @array[n][1]
//if element @array[k][1] is not @array[k][0] -> attach array[k][1] to the output
    if (count($Tasks) == 1){
        $key = key($Tasks);
        return ($Tasks[$key][0])."".$Tasks[$key][1];
    }else{
        for ($arraySteps = 0; $arraySteps<count($Tasks)-1; ++$arraySteps) {
            if (!isset($Tasks[$arraySteps])){
                continue;
            }

            if (!array_search($Tasks[$arraySteps][0], $Tasks)){
                print_r(array_search($Tasks[$arraySteps][0], $Tasks));
                return $Tasks[$arraySteps][0];
            }

        }
    }


}

//findNextTask(filereader("testInput.txt"));

function testD7part01(){
    if (D7part01(filereader("testInput.txt")) === "CABDFE"){
        echo "Testdata: OKAY\nStarting with the Dataset: ";
        if(D7part01(filereader("input.txt")) ==="AEMNPOJWISZCDFUKBXQTHVLGRY"){
            echo "\nPart01: Correct!\n";
        }
        else{
            echo "\n";
            print_r(D7part01(filereader("input.txt")));
            echo " is NOT = \"AEMNPOJWISZCDFUKBXQTHVLGRY\"\n";
        }
    }else{
        echo "Test Failed!\n";
        print_r(D7part01(filereader("testInput.txt")));
        echo "\n";
    }
}
testD7part01();
