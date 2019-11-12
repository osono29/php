<?php
// $a = 1 <=> 12.7;
// print $a;
// $b = "charlie" <=> "bob";
// print $b;
// $x = '6 pack' <=> '55 card stud';
// print $x;

// $i = 1;
// print '<select name="people">';
// while($i <= 10) {
//     print "<option>$i</option>¥n";
//     $i++;
// }
// print '</select>';

 // $array = [0 => 'お', 1 => 'そ', 2 => 'の', 3 => 'た', 4 => 'く', 5 => 'ま'];
 // $array = ['お','そ','の','た','く','ま'];
 // $array[] = '小';
 // $array[] = '薗';
 // $array[] = '拓';
 // $array[] = '真';
 // for($i = 0; $i < count($array); $i++) {
 //    // print "$i¥n";
 //    print $array[$i];
 // }

//  $row_styles = ['even', 'odd'];
//  $style_index = 0;
//  $meal = [
//    'breakfast' => 'Walnut Bun',
//    'lunch' => 'Cashew Nuts and White Mushrooms',
//    'snack' => 'Dried Mulberries',
//    'dinner' => 'Eggplant with Chili Sauce'
//  ];
// print "<table>¥n";
// foreach($meal as $key => $value) {
//   print '<tr class="' . $row_styles[$style_index] . '">';
//   print "<td>$key</td><td>$value</td></tr>¥n";
//   $style_index = 1 - $style_index;
// }
// print '</table>';

// $meals['breakfast'] = 'Walnut Bun';
// $meals['lunch'] = 'Eggplant with Chili Sauce';
// $amounts = array(3, 6);
// print "For breakfast, I'd like {$meals['breakfast']} and for lunch,\n";
// print "I'd like $meals[lunch]. I want $amounts[0] at breakfast and\n";
// print "$amounts[1] at lunch.";

// $dimsum = [
//   'Chicken Bun',
//   'Stuffed Duck Web',
//   'Turnip Cake'
// ];
// print '<table>';
// print '<tr><td>' . implode('</td><td>', $dimsum) . '</td></tr>';
// print '</table>';

// $fish = 'Bass, Carp, Pike, Flounder';
// $fish_list = explode(', ', $fish);
// for($i = 0; $i < count($fish_list); $i++) {
//   print "<tr><td>";
//   print "$fish_list[$i]</td></tr></br>";
// }

// $usaJinkou = [
//   'New York' => 8175133,
//   'Los Angeles' => 3792621,
//   'Chicago' => 2695598,
//   'Houston' => 2100263,
//   'Philadelphia' => 1526006,
//   'Phoenix' => 1445632,
//   'San Antonio' => 1327407,
//   'San Diego' => 1307402,
//   'Dallas' => 1197816,
//   'San Jose' => 945942
// ];
// $jinkouTotal = 0;
// print '<table>';
// foreach($usaJinkou as $key => $value) {
//   print '<tr><td>' . $key . '</td><td>' . $usaJinkou[$key] . '</td></tr></br>';
//   $jinkouTotal += $usaJinkou[$key];
// }
// print "<tr><td>Total</td><td>$jinkouTotal</td></tr>";
// print '</table>';
//
//
// print 'asort↓↓↓↓↓↓';
// asort($usaJinkou);
// $jinkouTotal = 0;
// print '<table>';
// foreach($usaJinkou as $key => $value) {
//   print '<tr><td>' . $key . '</td><td>' . $usaJinkou[$key] . '</td></tr></br>';
//   $jinkouTotal += $usaJinkou[$key];
// }
// print "<tr><td>Total</td><td>$jinkouTotal</td></tr>";
// print '</table>';
//
//
// print 'ksort↓↓↓↓↓↓';
// ksort($usaJinkou);
// $jinkouTotal = 0;
// print '<table>';
// foreach($usaJinkou as $key => $value) {
//   print '<tr><td>' . $key . '</td><td>' . $usaJinkou[$key] . '</td></tr></br>';
//   $jinkouTotal += $usaJinkou[$key];
// }
// print "<tr><td>Total</td><td>$jinkouTotal</td></tr>";
// print '</table>';

$usaJinkou = [
  'New York' => ['NY',8175133],
  'Los Angeles' => ['CA',3792621],
  'Chicago' => ['IL',2695598],
  'Houston' => ['TX',2100263],
  'Philadelphia' => ['PA',1526006],
  'Phoenix' => ['AZ',1445632],
  'San Antonio' => ['TX',1327407],
  'San Diego' => ['CA',1307402],
  'Dallas' => ['TX',1197816],
  'San Jose' => ['CA',945942]
];
$shuTotal = [
  'NY' => 0,
  'CA' => 0,
  'IL' => 0,
  'TX' => 0,
  'PA' => 0,
  'AZ' => 0
];

print '<table>';
foreach($usaJinkou as $key1 => $value1) {
  if($value1[0] === 'NY') {
    $shuTotal['NY'] += $value1[1];
  } else if($value1[0] === 'CA') {
    $shuTotal['CA'] += $value1[1];
  } else if($value1[0] === 'IL') {
    $shuTotal['IL'] += $value1[1];
  } else if($value1[0] === 'TX') {
    $shuTotal['TX'] += $value1[1];
  } else if($value1[0] === 'PA') {
    $shuTotal['PA'] += $value1[1];
  } else if($value1[0] === 'AZ') {
    $shuTotal['AZ'] += $value1[1];
  }
}
foreach($shuTotal as $key2 => $value2) {
  print '<tr><td>' . $key2 . '</td><td>' . $shuTotal[$key2] . '</td></tr></br>';
}
print '</table>';

 ?>
