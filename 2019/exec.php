<?php
namespace AoC\run;
include 'Day1/day01.php';
include 'Day02/day02.php';
include 'Day03/day03.php';
use AoC\Days\day01;
use AoC\Days\day02;
use AoC\Days\day03;

$day01 = new day01();
$day01->run();

$day02 = new day02();
$day02->run();

$day03 = new day03();
$day03->run();