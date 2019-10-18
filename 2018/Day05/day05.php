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






function part01(){}
function part02(){}