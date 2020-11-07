<?php


namespace AoC;
include_once __DIR__.'/../FileReader.php';

abstract class AbstractDay
{
    protected $dayNumber = "N/A";

    public $InputArray;

    public function __construct($inFile)
    {
        $this->InputArray = FileReader::read($inFile);
    }


    abstract protected function part1();
    abstract protected function part2();

    public function run()
    {
        echo "Day $this->dayNumber Part 1/2:\n";
        echo $this->part1();
        echo "\n";
        echo "Day $this->dayNumber Part 2/2:\n";
        echo $this->part2();
        echo "\n";
    }
}


