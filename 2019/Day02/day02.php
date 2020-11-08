<?php


namespace AoC\Days;


use AoC\AbstractDay;
use AoC\FileReader;

class day02 extends AbstractDay
{
    protected $dayNumber = 2;

    public function __construct($inFile = __DIR__."/testInput.txt")
    {
        $this->InputArray = FileReader::readCSV($inFile);
        $this->InputArray = $this->InputArray[0];
    }

    protected function part1()
    {
        $this->InputArray[1] = 12;
        $this->InputArray[2] = 2;

        $step = 4;
        $optCodePosition = 0;
        while (true) {

            $optCode = $this->InputArray[$optCodePosition];

            if ($optCode == 99) {

                return $this->InputArray[0];
            }

            $firstIntPosition = $this->InputArray[$optCodePosition + 1];
            $firstInt = $this->InputArray[$firstIntPosition];
            $secondIntPosition = $this->InputArray[$optCodePosition + 2];
            $secondInt = $this->InputArray[$secondIntPosition];
            $resultPosition = $this->InputArray[$optCodePosition + 3];

            if ($optCode == 1) {

                $this->InputArray[$resultPosition] = $firstInt + $secondInt;
            } elseif ($optCode == 2) {
                $this->InputArray[$resultPosition] = $firstInt * $secondInt;
            } else {
                return "Error!";
            }
            $optCodePosition += $step;
        }

    }

    protected function part2()
    {
        // TODO: Implement part2() method.
    }
}