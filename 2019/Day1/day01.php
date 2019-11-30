#!/usr/bin/php
<?php

function prepareInput($infile){
    //Function that returns the contents of a file and stores it line by line in an array
    $handle = fopen($infile, "r") or die ("Unable to open the requested File");
    $array[] = fgets($handle);
    fclose($handle);
    preg_match_all("/\d+/",$array[0],$array);
    return $array[0];
}

function encrypter($Value, $Salt){
    return sha1($Salt . $Value . $Salt);
}

function is_Correct_Hash($Hash, $Value, $Salt){
    return $Hash === encrypter($Value, $Salt) ? TRUE : FALSE;
}

$Value = "MySecretString";
$Salt = "SuperSalty";

$Hash = encrypter($Value, $Salt);
if(is_Correct_Hash($Hash, $Value, $Salt)){
    echo "True\n";
}else{
    echo "False\n";
} 