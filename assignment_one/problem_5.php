<?php
function sumOfDigits($number){
    $sum = 0;
    $number = abs($number);
    while($number > 0){
        $digit = $number % 10;
        $number = (int) ($number / 10);
        $sum += $digit;
    }
    return $sum;
}

echo sumOfDigits(62343);
// echo sumOfDigits(1000);
// echo sumOfDigits(-62343);
