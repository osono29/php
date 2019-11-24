<?php
// function a($a = 'a') {
//   print $a;
// }
// print 'b';
// a();

// function countdown($top) {
//   while($top > 0) {
//     print "$top..";
//     $top--;
//   }
//   print "boom!</br>";
// }
//
// $counter = 5;
// countdown($counter);
// print "Now, counter is $counter";

// require 'restaurant-functions.php';
// $total_bill = restaurant_check(25, 8.875, 20);
// $cash = 300;
// print "I need to pay with " . payment_method($cash, $total_bill);

// $base = '//images//';
// function img($url) {
//   $baseUrl = $GLOBALS['base'] . $url;
//   $res = '<img src="' . $baseUrl . '" />';
// }

print colorStr(255, 0, 255);
print web_color2(255, 255, 255);

function colorStr($red, $green, $blue) {
  $res = [dechex($red), dechex($green), dechex($blue)];
  foreach($res as $i => $val) {
    if(strlen($val) === 1) {
      $res[$i] = "0$val";
    }
    print $res[$i] . '</br>';
  }
  return '#' . implode('', $res) . '</br>';
}

  /* sprintf()の%xフォーマット文字を利用して
  16進数から10進数への変換を行うこともできる */
function web_color2($red, $green, $blue) {
  return sprintf('#%02x%02x%02x', $red, $green, $blue);
}

 ?>
