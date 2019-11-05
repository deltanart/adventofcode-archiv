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
    while(!empty($Tasks)){
        $CurrentTask = findNextTask($Tasks);
        $Tasks = deleteTaskFromArray($Tasks,$CurrentTask);
        $output .= $CurrentTask;
    }

    $output = str_replace(" ", "", $output);
    return $output;
}

function D7part02($Tasks){
    $worker0 = array();
    $worker1 = array();
    $worker2 = array();
    $worker3 = array();
    $worker4 = array();


}

//function that deletes the task from the array on every instance to move on
function deleteTaskFromArray($Tasks, $toDelete){
    if (!empty($Tasks) and isset($toDelete)){
        foreach ($Tasks as $key => $item) {
            if($item[0] === $toDelete){
                unset($Tasks[$key]);
            }
        }
        return array_values($Tasks);
    }
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
        echo D7part01(filereader("testInput.txt"))."\n";
        echo "Testdata: OKAY\nStarting with the Dataset: ";
    }else{
        echo D7part01(filereader("testInput.txt"))."\n";
    }
    if(D7part01(filereader("input.txt")) ==="AEMNPOJWISZCDFUKBXQTHVLGRY"){
        echo "\nPart01: Correct!\n";
    }
    else{
        echo "\n";
        print_r(D7part01(filereader("input.txt")));
        echo " is NOT = \"AEMNPOJWISZCDFUKBXQTHVLGRY\"\n";
    }

}

testD7part01();

function timetestP1($TimeToRun)
{
    $counter = 0;
    $time_start = microtime(TRUE);
    $time_end = microtime(TRUE);
    $time = $time_end - $time_start;
    while ($time <= $TimeToRun) {
        testD7part01();
        $counter += 1;
        $time_end = microtime(TRUE);
        $time = $time_end - $time_start;
    }
    // Die Skriptverarbeitung fuer einen bestimmten Zeitraum unterbrechen
    echo "In $time Sekunden wurde die Funktion $counter Mal ausgeführt\n";
}
//timetestP1(10);