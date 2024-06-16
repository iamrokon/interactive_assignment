<?php
function minValue($arr){
    if(count($arr) == 0){
        echo "Empty array";
        return;
    }
    $min = $arr[0] < 0 ? -1 * $arr[0] : $arr[0];
    for($i = 1; $i < count($arr); $i++){
        $value = $arr[$i] < 0 ? -1 * $arr[$i] : $arr[$i];
        if($min > $value){
            $min = $value;
        }
    }

    // $arr = array_map('abs', $arr);
    // $min = min($arr);

    return $min;
}

echo minValue([10, 12, 15, 189, 22, 2, 34]);
// echo minValue([10, -12, 34, 12, -3, 123]);
// echo minValue([]);