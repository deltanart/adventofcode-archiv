<?php
namespace AoC\Days;
use AoC\FileReader;

Class day01{

    const INPUT_FILE = __DIR__."/input.txt";
    protected $InputArray;


    public function __construct()
    {
        $this->InputArray = FileReader::read(self::INPUT_FILE);
    }

    function fuelPerModule($Mass){

        $fuel = (floor((int) $Mass/3)) -2;
        return $fuel;
    }

    public function d1p1(){
        $fuelparts = array();
        foreach ($this->InputArray as $Input){
            $fuelparts[] = $this->fuelPerModule($Input);
        }
        return $fuelparts;
    }

    public function d1p2(){
        $InputMassArray = $this->d1p1();
        $MassPerModule = [];
        foreach ($InputMassArray as $InputMass){
            $Mass = $InputMass;
            $MassArray = array($Mass);
            while($this->fuelPerModule($Mass) > 0){
                $Mass = $this->fuelPerModule($Mass);
                $MassArray[] = $Mass;
            }
            $MassPerModule[] = array_sum($MassArray);
        }
        return array_sum($MassPerModule);

    }

    public function run(){
        echo "Day 1 Part 1/2:\n";
        echo array_sum($this->d1p1());
        echo "\n";
        echo "Day 1 Part 2/2:\n";
        echo $this->d1p2();
        echo "\n";
    }
}



