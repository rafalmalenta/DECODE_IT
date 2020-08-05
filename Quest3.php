<?php
function extractShortStrings($longstring, $shortstringCount){
    for($i=0;$i<$shortstringCount;$i++) {
        $FourChars[] = substr($longstring, (4*(int)$i), 4);
    }
    return $FourChars;
}
function decodeChars($chars){
    $first = substr($chars, 0, 1);
    $second = substr($chars, 1, 1);
    $third = substr($chars, 2, 1);
    $fourth = substr($chars, 3, 1);
    $sum = (int)($first.$third)+(int)($second.$fourth);
    $ASCII = chr($sum);
    return $ASCII;
}
$stdin = fopen('php://stdin', 'r');
$testCount = trim(fgets($stdin));
for($i=0;$i<$testCount;$i++){
    $charCount = trim(fgets($stdin));
    $string = trim(fgets($stdin));
    $lex = extractShortStrings($string,$charCount);
    $ASCIIString= "";
    foreach ($lex as $code){
        $ASCIIString = $ASCIIString.decodeChars($code);
    }
    $ASCIIArray[] = $ASCIIString;
}
foreach ($ASCIIArray as $code){
    echo ("$code \n");
}
//var_dump($ASCIIArray);
