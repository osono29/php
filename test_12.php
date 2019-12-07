<?php
// パースエラー
// if $logged_in) {
//   print "Welcome, user.";
// }

// 面倒なパースエラー
// $first_name = "David';
// if($logged_in) {
//   print "Welcome, $first_name";
// } else {
//   print "Howdy, Stranger.";
// }

// die('This is: ' . __FILE__);

// // デバッグ出力付きの壊れたプログラム
// $prices = array(5.95, 3.00, 12.50);
// $total_price = 0;
// $tax_rate = 1.08; // 税金8%
//
// foreach($prices as $price) {
//   // print "[before: $total_price]";
//   error_log("[before: $total_price]");
//   $total_price = $price * $tax_rate;
//   // print "[after: $total_price]";
//   error_log("[after: $total_price]");
// }
//
// printf('Total price (with tax): $%.2f', $total_price);

// var_dump()を使ったサブミットされた全てのフォームパラメータの出力
// print '<pre>';
// var_dump($_POST);
// print '</pre>';

// var_dump()を使ったサブミットされた全てのフォームパラメータのエラーログへの送信
// 出力を表示する代わりに補足する
ob_start();
// 通常通りにvar_dump()を呼び出す
var_dump($_POST);
// ob_start()の呼び出し後に生成された出力を$outputに格納する
$output = ob_get_contents();
// 通常の出力表示に戻す
ob_end_clean();
// $outputをエラーログに送る
error_log($output);

// カスタム例外ハンドラの設定
function niceExceptionHandler($ex) {
  // ユーザに脅威ではないことを伝える
  print "Sorry! Something unexpected happend. Please try again later.";
  // システム管理者が精査するための詳細情報をロギングする
  error_log("{$ex->getMessage()} in {$ex->getFile()} @ {$ex->getLine()}");
  error_log($ex->getTraceAsString());
}

set_exception_handler('niceExceptionHandler');

print "I`m about to connect to a made up, pretend, broken database!<br/>";

// PDOコンストラクタに渡すDSNが有効なデータベースや
// 接続パラメータを示していないので、コンストラクタは例外を発行する
$db = new PDO('garbage:this is obviously not going to work!');

print ("This is not going to get printed.");
 ?>
