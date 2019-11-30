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
