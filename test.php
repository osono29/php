<?php
// $a = ' abc ';
// print $a;
// $a_len = strlen($a);
// print "長さは：$a_len";
//
// $b = trim($a);
// print $b;
// $b_len = strlen($b);
// print "長さは：$b_len";
// print ucwords(strtolower('OSONO TAKUMA'));
// $num = '1234-5678-9101-1213';
// print "Card:XX" . substr($num,-4);
 // $a = "小薗";
 // $b = "拓真";
 // print $a . $b;
 // print "¥n";
 // print "$a$b";
 // print "¥n";
 // print "{$a}$b";
// print <<<NAME
// <html>
// <head><title>Name</title></head>
// <body bgcolor="fffed9">
// <h1>名前</h1>
// 私の名前は<br>"$c"<br>です。
// NAME

// $hum_pri = 4.95 * 2;
// $cho_pri = 1.95;
// $cola = 0.85;
// $sum = $hum_pri + $cho_pri + $cola;
// $tax = $sum * 0.075;
// $chip = $sum * 0.16;
// $sum_tax = $sum + $tax;
// $all = $sum_tax + $chip;
// $first_name = "拓真";
// $last_name = "小薗";
// $name = "$first_name/$last_name";
// $name_length = strlen($name);
// print <<<prise
// <html>
//  名前：$name
//  <br>
//  名前の文字数：$name_length
//  <br>
//  ハンバーガー：$4.95 2個
//  <br>
//  チョコレートミルクシェイク：$1.95 1個
//  <br>
//  コーラ：¢85 1個
//  <br>
//  ----------------------------------
//  <br>
//  合計（税抜）；$$sum
//  <br>
//  合計（税込）；$$sum_tax
//  <br>
//  合計（税込,チップ込み）：$$all
// prise

/*
 練習問題　2章
 問6
*/
$n = 1;
$p = 2;
// 以下出力
print "$n, $p<br>";
$n++;
$p *= 2;
print "$n, $p<br>";
$n++;
$p *= 2;
print "$n, $p<br>";
$n++;
$p *= 2;
print "$n, $p<br>";
$n++;
$p *= 2;
print "$n, $p<br>";


?>
