<?php
function wordCount($str){

    $words = preg_split('/\s+/', $str);
    $new_words = array_filter($words, function($word){
        return $word !== "";
    });
    $no_of_words = count($new_words);
    // $no_of_words = str_word_count($str);
    return $no_of_words;
}

// $filename = 'pr2.txt';
$filename = 'F:/laragon/www/interactive_assignment/assignment_one/pr2.txt';
$file_content = file_get_contents($filename);
echo wordCount($file_content);
