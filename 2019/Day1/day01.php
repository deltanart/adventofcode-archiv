<?php
declare(strict_types=1);
namespace AoC\Days;
include __DIR__."/../AbstractDay.php";
use AoC\AbstractDay;
use AoC\FileReader;

Class day01 extends AbstractDay {
    protected $dayNumber = 1;

    public function __construct($inFile = __DIR__."/input.txt")
    {
        $this->InputArray = FileReader::read($inFile);
    }

    protected function part1()
    {
        return array_sum($this->d1p1());
    }

    protected function part2()
    {
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


    function fuelPerModule($Mass){

        $fuel = (floor((int) $Mass/3)) -2;
        return $fuel;
    }

    function d1p1(){
        $fuelparts = array();
        foreach ($this->InputArray as $Input){
            $fuelparts[] = $this->fuelPerModule($Input);
        }
        return $fuelparts;
    }



}



