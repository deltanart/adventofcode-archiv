<?php


namespace AoC\Days;


use AoC\AbstractDay;
use AoC\FileReader;

class day02 extends AbstractDay
{
    protected $dayNumber = 2;

    public function __construct($inFile = __DIR__."/testInput.txt")
    {
        $this->resetInput($inFile);
    }

    function resetInput($inFile = __DIR__."/testInput.txt"){
        $this->InputArray = FileReader::readCSV($inFile);
        $this->InputArray = $this->InputArray[0];
    }

    function prozessor($noun, $verb){
        $this->InputArray[1] = $noun;
        $this->InputArray[2] = $verb;

        $step = 4;
        $optCodePosition = 0;
        $iteration = 0;
        while (true) {
            $iteration +=1;

            $optCode = $this->InputArray[$optCodePosition];

            if ($optCode == 99) {

                return $this->InputArray[0];
            }

            $firstIntPosition = $this->InputArray[$optCodePosition + 1];
            $secondIntPosition = $this->InputArray[$optCodePosition + 2];
            $resultPosition = $this->InputArray[$optCodePosition + 3];

            $secondInt = $this->InputArray[$secondIntPosition];
            $firstInt = $this->InputArray[$firstIntPosition];

            if ($optCode == 1) {

                $this->InputArray[$resultPosition] = $firstInt + $secondInt;
            } elseif ($optCode == 2) {
                $this->InputArray[$resultPosition] = $firstInt * $secondInt;
            } else {
                #return "Error! @$optCodePosition; Iteration: $iteration";
            }
            $optCodePosition += $step;

        }
    }

    protected function part1()
    {
       return $this->prozessor(12,2);
    }

    protected function part2()
    {
        $noun = 0;
        $verb = 0;
        for ($noun; $noun<100; $noun++){

            for ($verb; $verb<100; $verb++){
                $this->resetInput();
                if ($this->prozessor($noun, $verb) == 19690720){
                    echo $noun ."; " .$verb."; ";
                    return 100 * $noun + $verb;
                }else{
                    #echo $this->prozessor($noun, $verb). "; ";
                }
            }
        }

    }


}