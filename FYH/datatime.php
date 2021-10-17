<?php

    $mt = explode(' ', microtime());
    echo $milliseconds = ((int)$mt[1]) * 1000 + ((int)round($mt[0] * 1000));
echo "<br>";

$d = date("Hisu", $milliseconds/1000);
print $d;
echo "<br>";
echo "<br>";
echo $micro_date = microtime();
echo "<br>";
$date_array = explode(" ",$micro_date);
$date = date("His",$date_array[1]);
echo "Date: $date:" . $date_array[0]."<br>";
?>