<?php
$stdin = fopen('php://stdin', 'r');

$line = explode(" ", trim(fgets($stdin)));

$SorobanColCount = $line[0];
$SorobanBeads = $line[1];

$beadsForEach = floor($SorobanBeads/$SorobanColCount);
$additionalBeads  = $SorobanBeads % $SorobanColCount;
$possibleNumbers = 1;

for($i=0;$i<$SorobanColCount;$i++){
    if($additionalBeads>0){
        $possibleNumbers = $possibleNumbers * (2 + 2*($beadsForEach+1));
        $additionalBeads--;
    }
    else
        $possibleNumbers = $possibleNumbers * (2 + 2*$beadsForEach);

}
echo $possibleNumbers;