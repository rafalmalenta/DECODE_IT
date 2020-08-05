<?php
$stdin = fopen('php://stdin', 'r');
function sortas($array,$order){
    if($order=="NOTDESC"){
       //var_dump(count($array));
        for($k=0;$k<count($array)-1;$k++)
        for($i=0;$i<count($array)-1;$i++){
            if($array[$i]<$array[$i+1]){
                $temp = $array[$i];
                $array[$i] = $array[$i+1];
                $array[$i+1] = $temp;
            }
        }
        return (int)implode($array);
    }
    else{
        for($k=0;$k<count($array)-1;$k++)
        for($i=0;$i<count($array)-1;$i++){
            if($array[$i]>$array[$i+1]){
                $temp = $array[$i];
                $array[$i] = $array[$i+1];
                $array[$i+1] = $temp;
            }
        }
        return (int)implode($array);
    }
}
function digitToArray($number)
    {
        for ($i = 0; $i < strlen($number); $i++) {
            $digitArray[] = substr($number, $i, 1);
        }
        return $digitArray;
    }

//$digitArray = digitToArray($number);
function howMuchIteration($number)
{
    for ($i = 0; $i < 110; $i++) {
        $digitArray = digitToArray($number);
        if ($number == 6174) return $i;

        $digitNotDesc = sortas($digitArray, "NOTDESC");
        $digitNotASC = sortas($digitArray, "NdsaOTDESC");
        if ($digitNotDesc == $digitNotASC)return -1;
        $number = $digitNotDesc - $digitNotASC;
        $number = str_pad($number, 4, 0, STR_PAD_LEFT);

    }
    return -1;
}

$t = trim(fgets($stdin));

for ($i = 0; $i < $t; $i++) {
    $number = trim(fgets($stdin));
    $ile[] = howMuchIteration($number);
}
foreach ($ile as $el){
    echo ("$el \n");
}
