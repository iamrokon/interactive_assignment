<?php
function pyramid($no_of_rows){
    for($i = 1, $j = 1; $i <= $no_of_rows; $i++,$j+=2){
        for($l = $i; $l < $no_of_rows; $l++){
            // echo "&nbsp&nbsp";
            echo " ";
        }
        for($k = 1; $k <= $j; $k++){
            echo "*";
        }
        // echo "</br>";
        echo "\n";
    }
}

pyramid(5);
