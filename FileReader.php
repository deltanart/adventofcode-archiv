<?php

namespace AoC;

class FileReader
{
    public function __construct()
    {
    }

    static function read($infile){


        //Function that returns the contents of a file and stores it line by line in an array
        $array = array();
        $handle = fopen($infile, "r") or die ("Unable to open the requested File; Requested File: ".$infile);
        while ($line = fgets($handle)){
            array_push($array, $line);
        }
        fclose($handle);
        return $array;
    }

    static function readCSV($infile){
        return array_map('str_getcsv', file($infile));
    }
}