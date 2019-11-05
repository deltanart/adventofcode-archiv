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
    return $filteredInput;
}


function D7part01($Tasks){
    $output = "";
    do{
        $CurrentTask = findNextTask($Tasks);
        $Tasks = deleteTaskFromArray($Tasks,$CurrentTask);
        $output .= $CurrentTask;
    }while(count($Tasks) > 1);
    $CurrentTask = findNextTask($Tasks);
    $output .= $CurrentTask;
    $output = str_replace(" ", "", $output);
    return $output;
}

function D7part02($Tasks){

}

//function that deletes the task from the array on every instance to move on
function deleteTaskFromArray($Tasks, $toDelete){
    $NumDeletions = 0;
    foreach ($Tasks as $key => $item) {
        if($item[0] == $toDelete){
            $NumDeletions += 1;
            unset($Tasks[$key]);
        }
    }
    if ($Tasks === NULL){
        exit("We are done here!\n");
    }
    return array_values($Tasks);
}

function testDeleteTaskFromArray(){
    if (deleteTaskFromArray(array(array("A","B"), array("B", "C")),"A") === array(array("B","C")))
    {echo "Del Test: True\n";}else{echo "Del Test: False\n";}
}
testDeleteTaskFromArray();


//function that finds the next task that has no dependency upfront
function findNextTask($Tasks){
//get element @array[k][0] that is not @array[n][1] -> get the current Task that has no dependency
//if element @array[k][1] is not @array[k][0] -> attach array[k][1] to the output -> LAST ELEMENT
    $AvailableNextTasks = array();
    if (count($Tasks) === 1){
        $key = key($Tasks);
        return ($Tasks[$key][0])."".$Tasks[$key][1];
    }else{
        for ($arraySteps = 0; $arraySteps<count($Tasks); ++$arraySteps) {

            foreach ($Tasks as $task) {
                if (!isset($Tasks[key($task)])) {
                    continue;
                }
                if ($Tasks[$arraySteps][0] === $task[1]) {
                    continue 2;
                }

            }
            if (!in_array($Tasks[$arraySteps][0],$AvailableNextTasks)){
                $AvailableNextTasks[] = $Tasks[$arraySteps][0];
            }


        }
        $NextTask = $AvailableNextTasks[0];
        foreach ($AvailableNextTasks as $availableTask) {
            if (strcmp($availableTask,$NextTask) < 0){
                $NextTask = $availableTask;
            }
        }
        return $NextTask;
    }
}


//findNextTask(filereader("testInput.txt"));

function testD7part01(){
    if (D7part01(filereader("testInput.txt")) === "CABDFE"){
        //echo "Testdata: OKAY\nStarting with the Dataset: ";
        if(D7part01(filereader("input.txt")) ==="AEMNPOJWISZCDFUKBXQTHVLGRY"){
            //echo "\nPart01: Correct!\n";
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





$time_start = microtime(true);
$time_end = microtime(true);
$time = $time_end - $time_start;

// Die Skriptverarbeitung fuer einen bestimmten Zeitraum unterbrechen
$counter = 0;
while ($time < 1.0){
    testD7part01();
    $counter += 1;
    $time_end = microtime(true);
    $time = $time_end - $time_start;
}


$time_end = microtime(true);
$time = $time_end - $time_start;

echo "In $time Sekunden die Funktion $counter Mal ausgeführt\n";
