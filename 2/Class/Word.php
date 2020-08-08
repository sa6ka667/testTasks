<?php
Class Word 
{
    public static function getWord($colorsAndWords){
        $arraySize = count($colorsAndWords);
        $colorPosition = rand(0,$arraySize-1);
        $wordPosition = rand(0,$arraySize-1);
        if ($colorPosition != $wordPosition){
            $color = $colorsAndWords[$colorPosition];
            $word = $colorsAndWords[$wordPosition];  
            $text = "<p style = 'color: $color'><b>$word</b></p>";
            return $text;
        }else{
            return Word::getWord($colorsAndWords);
        }
           
    } 
}