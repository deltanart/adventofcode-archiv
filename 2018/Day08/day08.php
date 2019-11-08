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
    private $Children = array();
    private $Metadata = array();
    private $SumMetadata;
    private $NodeValue;

    public function __construct(&$Input)
    {
        $this->NumOfChildren = array_shift($Input);
        $this->NumOfMetadata = array_shift($Input);

        if ($this->NumOfChildren > 0){
            for ($ChildNumber = 1; $ChildNumber <= $this->NumOfChildren; $ChildNumber++){
                $this->Children[$ChildNumber] = new Node($Input);
                $this->SumMetadata += $this->Children[$ChildNumber]->SumMetadata;//Saves the Sum of the Metadata from each Child
            }
        }
        if ($this->NumOfMetadata !== 0){
            for ($eachMetaData = 0; $eachMetaData<$this->NumOfMetadata; $eachMetaData++){
                $this->Metadata[] = array_shift($Input);
            }
            $this->SumMetadata += array_sum($this->Metadata);
        }
        //Nodevalue
        if (count($this->Children) == 0){
            $this->NodeValue = $this->SumMetadata;
        }else{
            foreach ($this->Metadata as $MetaKey => $MetaEntry) {
                if (isset($this->Children[$MetaEntry])){
                    $this->NodeValue += $this->Children[$MetaEntry]->NodeValue;
                }
            }
        }
    }

    public function part01(){
        echo "Part 01: ".$this->SumMetadata."\n";
    }

    public function part02(){
        echo "Part 02: ".$this->NodeValue."\n";
    }

}

$Input = prepareInput("input.txt");
$Test = new Node($Input);
$Test->part01();
$Test->part02();
