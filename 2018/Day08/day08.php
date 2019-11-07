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

function prepareInput($infile){
    //Function that returns the contents of a file and stores it line by line in an array
    $handle = fopen($infile, "r") or die ("Unable to open the requested File");
    $array[] = fgets($handle);
    fclose($handle);
    preg_match_all("/\d+/",$array[0],$array);
    return $array[0];
}

/**
 * Class Node
 */
class Node{
    private $NumOfChildren;
    private $NumOfMetadata;
    private $CurrentInput;
    private $Children = array();
    private $Metadata = array();
    private $SumMetadata;

    public function __construct($Input)
    {
        $this->CurrentInput = $Input;
        $this->NumOfChildren = array_shift($this->CurrentInput);
        $this->NumOfMetadata = array_shift($this->CurrentInput);


        if ($this->NumOfChildren > 0){
            for ($NumberOfChildren = 1; $NumberOfChildren <= $this->NumOfChildren; $NumberOfChildren++){
                $this->Children[$NumberOfChildren] = new Node($this->CurrentInput);
                $ChildMeta = $this->Children[$NumberOfChildren];
                $ChildMeta = $ChildMeta->SumMetadata;
                $this->SumMetadata += $ChildMeta;
            }
        }
        if ($this->NumOfMetadata !== 0){
            for ($eachMetaData = 0; $eachMetaData<$this->NumOfMetadata; $eachMetaData++){
                $this->Metadata[] = array_shift($this->CurrentInput);
            }
            $this->SumMetadata += array_sum($this->Metadata);
        }return $this->CurrentInput;

    }

}

$Test = new Node(prepareInput("testInput.txt"));
print_r($Test);
