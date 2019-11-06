#!/usr/bin/php
<?php
/*
  * What is this Class About?
  * The Node-Class should create an Tree-Object containing it's:
  * +Parent ID
  * +an (auto-generated) ChildID Array -> Array of all its children ID's
  * If it has no children it is the end of that branch and should return as far as it can split into
  * the next Branch and on its way up collect the Metadata and fills it into the corresponding objects ->
  * + but also places them into an global array that just contains all Metadata in no special order (in the end)
  * each object also keeps track of its own amount of children and number of Metadata
  *
  * While the program reads the data in it should also delete the entries it already has used
  */

/**
 * Class Node
 */
class Node{
    private $ID;
    private $IDParent;
    private $NumOfChildren;
    private $NumOfMetadata;
    private $Children = array();
    private $Metadata = array();

    //#   - Functions -

    function prepareInput($infile){
        //Function that returns the contents of a file and stores it line by line in an array
        $handle = fopen($infile, "r") or die ("Unable to open the requested File");
        $array[] = fgets($handle);
        fclose($handle);
        return $array;
    }

    function createChild($ID){
        $ID = new Node();
    }

    function getChildrenAmount(){}

    function getMetadataAmount(){}

    function getMetadata(){}




}

$Test = new Node();

print_r($Test->prepareInput("testInput.txt"));