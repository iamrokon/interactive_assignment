<?php
function reverseWord($str){
    $words = str_word_count($str, 1);
    $new_str = "";
    // for($i = 0; $i < count($words); $i++){
    //     $new_word = strrev($words[$i]);
    //     $new_str .= $new_word. " ";
    // }
    $new_words = array_map(function($word){
        return strrev($word);
    }, $words);
    $new_str = implode(' ', $new_words);
    return $new_str;
}

echo reverseWord("I love programming");
