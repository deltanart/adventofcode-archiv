#!/usr/bin/php
<?php
function filereader($infile){
    //Function that returns the contents of a file and stores it line by line in an array
    $array = array();
    $handle = fopen($infile, "r") or die ("Unable to open the requested File");
    while ($line = fgets($handle)){
        $array[]= $line;
    }
    fclose($handle);
    return $array;
}
function inputhandler($RawInput){
    $data = array();
    foreach ($RawInput as $line) {
        if(preg_match_all("/\[\d+-\d+-\d+\s\d+:\d+\]/", $line, $key)); //Regex für den Zeitstempel in den [ ] Klammern
        if(preg_match_all("/\d:\d+](\s*\w*)*(#\d+)*/", $line, $dataentry)); //Regex für alles hinter dem Zeitstempel
        $data[$key[0][0]] = $dataentry[0][0];
    }
    ksort($data);
    return $data;
}

function logMin($alldata){

    $arrayOfGuards = array();
    $guardidG = 0;

    foreach ($alldata as $dataentry) {
        if (preg_match_all("/#\d+/", $dataentry, $guardid)) {
            $id = (string)$guardid[0][0];
            if (!in_array($id, $arrayOfGuards)){
                $arrayOfGuards[] = $id;
            }
        }
    }
    $arrayOfGuards = array_flip($arrayOfGuards);
    echo count($arrayOfGuards);
    $emptyarray = array();
    for($j=0; $j<= 60; $j++) {
        $emptyarray[$j] = 0;
    }
    for($i=0; $i< count($arrayOfGuards); $i++) {
        $arrayOfGuards[array_search($i,$arrayOfGuards)] = $emptyarray;
    }
    guardMinCounter($arrayOfGuards, $alldata);


}

function guardMinCounter($guardarray, $data){
    foreach ($data as $dataentry) {
        if (preg_match_all("/#\d+/", $dataentry, $guardid)) {
            $id = (string)$guardid[0][0];
            $markStart = 0;
            $markEnd = 0;
        }
        if (preg_match_all("/\d+\]\s\w+\s\w+/", $dataentry, $status)){
            if (preg_match_all("/\d+\]\sfalls/", $status[0][0], $asleep)){
                if (preg_match_all("/\d+/",$asleep[0][0], $timestemp)){
                    $markStart = $timestemp[0][0];
                }
            }elseif(preg_match_all("/\d+\]\swakes/", $status[0][0], $asleep)){
                if (preg_match_all("/\d+/", $asleep[0][0], $timestemp)) {
                    $markEnd = $timestemp[0][0];
                }
             }
        }
        $markStart = (int)$markStart;
        $markEnd = (int)$markEnd;
        for ($i = $markStart; $i< $markEnd;$i++){
            $guardarray[$id][$i] += 1;
        }

    };
    part02($guardarray);



}


function part01($guardarray){
    $sleepingBeauty = 0;
    $sleepingBeautyID = 0;
    $minutes = -1;

    foreach ($guardarray as $key=> $item) {
        if (array_sum($item)>$sleepingBeauty){
            $sleepingBeauty = array_sum($item);
            $sleepingBeautyID = $key;
            arsort($item);
            $minutes = $item; //Compiler doesn't know this function.. Good n8;
        }
    }
    echo "ID: ".$sleepingBeautyID."\n";
    echo "Summe: ".$sleepingBeauty."\n";
    echo "Minute: ".key($minutes)."\n";
    if(preg_match_all("/\d+/", $sleepingBeautyID, $FinalID));//Regex für den Zeitstempel in den [ ] Klammern
    $IntID = (int)($FinalID[0][0]);
    $minute = key($minutes);
    $ergebniss = $IntID * $minute;
    echo "Finally: ". $ergebniss ."\n";
}
function part02($guardarray){
    $sleepingBeauty = 0;
    $sleepingBeautyID = 0;
    $minutes = -1;

    foreach ($guardarray as $key=> $item) {
        arsort($item);
        if (max($item)>$sleepingBeauty){
            $sleepingBeauty = max($item);
            $sleepingBeautyID=$key;
            $minutes = array_search($sleepingBeauty, $item); //Compiler doesn't know this function.. Good n8;
        }
    }
    echo "ID: ".$sleepingBeautyID."\n";
    echo "Summe: ".$sleepingBeauty."\n";
    echo "Minute: ".$minutes."\n";
    if(preg_match_all("/\d+/", $sleepingBeautyID, $FinalID));//Regex für den Zeitstempel in den [ ] Klammern
    $IntID = (int)($FinalID[0][0]);
    $minute = $minutes;
    $ergebniss = $IntID * $minute;
    echo "Finally: ". $ergebniss ."\n";
}

logMin(inputhandler(filereader("input.txt")));