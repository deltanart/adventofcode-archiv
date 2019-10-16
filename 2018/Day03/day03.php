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
    foreach ($RawInput as $line) {
        $line = preg_match_all('/(\d+)/',$line,$temp);
        $returner[] = $temp[0];
    }
    return $returner;
}

function parseClaims(array $lines) {
    $claims = [];
    foreach ($lines as $line) {
        $parts = explode(' ', str_replace(':', '', $line));
        $start = array_map('intval', explode(',', $parts[2]));
        $claim = [
            'id' => $parts[0],
            'start' => [$start[0], $start[1]]
        ];
        $claim['size'] = array_map('intval', explode('x', $parts[3]));
        $claim['end'] = [
            $claim['start'][0] + $claim['size'][0],
            $claim['start'][1] + $claim['size'][1]
        ];
        $claims[] = $claim;
    }
    return $claims;
}

function markFabric(array $claims){
    $fabric = [];
    $fabricSize = [1000, 1000];
    for ($x = 0; $x <= $fabricSize[0]; $x++) {
        for ($y = 0; $y <= $fabricSize[1]; $y++) {
            $fabric[$x][$y] = 0;
        }
    }
    foreach ($claims as $claim) {
        for ($x = $claim['start'][0]; $x < $claim['end'][0]; $x++) {
            for ($y = $claim['start'][1]; $y < $claim['end'][1]; $y++) {
                $fabric[$x][$y] = $fabric[$x][$y] + 1;
            }
        }
    }
    return $fabric;
}

function part1($lines) {
    $claims = parseClaims($lines );
    $fabric = markFabric($claims);
    $multiClaimed=0;
    array_walk_recursive($fabric, function ($value, $key) use(&$multiClaimed) {
        if($value > 1 ) $multiClaimed++;
    });
    return $multiClaimed;
}

function part2($lines) {
    $claims = parseClaims($lines );
    $fabric = markFabric($claims);
    foreach ($claims as $claim) {
        $tainted = 0;
        for ($x = $claim['start'][0]; $x < $claim['end'][0]; $x++) {
            for ($y = $claim['start'][1]; $y < $claim['end'][1]; $y++) {
                if($fabric[$x][$y]>1) $tainted=1;
            }
        }
        if($tainted==0) return $claim['id'];
    }
    return '--ERROR--';
}

echo part1(filereader("input.txt"));
echo part2(filereader("input.txt"));