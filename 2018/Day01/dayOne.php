<?php
$handle = fopen("input.txt", "r")or die ("Unable to read the input file");
$result = 0;
$findDoubles = array();
$found = 0;
for ($index = 0; $index<100000; $index++){
    while (($line = fgets($handle)) !== false) {
        // process the line read.
        $result += $line;

        foreach ($findDoubles as $findDouble) {

            if ($findDouble == $result){
                echo $result." ";
            }
        }

        array_push($findDoubles, $result);

    }
}

fclose($handle);
echo "Sum: ".$result."<br><br>";




