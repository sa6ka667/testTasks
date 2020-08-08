<?php
$text = $argv[1];
$array = explode(' ', $text);
$numericArray = array_filter($array,'isNumeric');
sort($numericArray);
$numericArray = array_unique($numericArray);
echo implode(' ' , $numericArray);
function isNumeric($item){
    if(is_numeric($item)){
        if (preg_match('/^[-+]?[0-9]\d*$/',$item)){
            return $item;
        }      
    }
}