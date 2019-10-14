<?php
$handle = fopen("input.txt", "r")or die ("Unable to read the input file");
$result = 0;

while (($line = fgets($handle)) !== false) {
    // process the line read.
    $result += $line;
}
fclose($handle);
echo $result;


