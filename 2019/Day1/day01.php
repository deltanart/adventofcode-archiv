#!/usr/bin/php
<?php

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

function fuelPerModule($Mass){
    return (floor($Mass/3) -2);
}

function d1p1($InputArray){
    $fuelparts = array();
    foreach ($InputArray as $Input){
        $fuelparts[] = fuelPerModule($Input);
    }
    return $fuelparts;
}

function d1p2($InputMassArray){
    $MassPerModule = array();
    foreach ($InputMassArray as $InputMass){
        $Mass = $InputMass;
        $MassArray = array($Mass);
        while(fuelPerModule($Mass) > 0){
            $Mass = fuelPerModule($Mass);
            $MassArray[] = $Mass; 
        }
        $MassPerModule[] = array_sum($MassArray);
    }
    return $MassPerModule;
    
}
echo "Day 1 Part 1/2:\n";

echo array_sum(d1p1(filereader("input.txt"))) . "\n\n";

echo "Day 1 Part 2/2:\n";

echo array_sum(d1p2(d1p1(filereader("input.txt")))) . "\n\n";
