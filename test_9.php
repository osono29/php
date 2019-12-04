<?php
  // テンプレートファイルを読み込む
  // $page = file_get_contents('page-template.html');
  //
  // // ページのタイトルを挿入する
  // $page = str_replace('{page_title}', 'Welcome', $page);
  //
  // // ページの色を午後は青、
  // // 午前は緑にする
  // if(date('H') >= 12) {
  //   $page = str_replace('{color}', 'blue', $page);
  // } else {
  //   $page = str_replace('{color}', 'green', $gape);
  // }
  //
  // // 以前に保存したセッション変数から
  // // ユーザ名を取得する
  // $page = str_replace('{name}', $_SESSION['username'], $page);
  //
  // // 結果を出力する
  // // print $page;
  //
  // // page.htmlに結果を書き込む
  // $result = file_put_contents('page.html', $page);
  // // file_put_contents()がfalseを返すか-1を返すかを調べる必要がある
  // if(($result === false) || ($result == -1)) {
  //   print "Couldn`t save HTML to page.html";
  // }
  //
  // // ファイルの各行へのアクセス
  // // foreach(file('people.txt') as $line) {
  // //   $line = trim($line);
  // //   $info = explode('|', $line);
  // //   print '<li><a href="mailto:' . $info[0] . '">' . $info[1] . "</li><br/>";
  // // }
  //
  // // 一度に1行のファイルの読み込み
  // $fh = fopen('people.txt', 'rb');
  // while((!feof($fh)) && ($line = fgets($fh))) {
  //   $line = trim($line);
  //   $info = explode('|', $line);
  //   print '<li><a href="mailto:' . $info[0] . '">' . $info[1] . "</li><br/>";
  // }
  // fclose($fh);

  // ファイルへのデータ書き込み
  // try{
  //   $db = new PDO('sqlite:/tmp/restaurant.db');
  // } catch(Exception $e) {
  //   print "Couldn`t connect to database: " . $e->getMessage();
  //   exit();
  // }

  // 書き込みのためにdishes.txtを開く
  // $fh = fopen('dishes.txt', 'wb');
  //
  // // $q = $db->query("SELECT dish_name, price FROM dishes");
  // // while($row = $q->fetch()) {
  // $q = [['apple', 5.0], ['meet', 10.0]];
  //   foreach($q as $row) {
  //   // 各行（末尾の改行を含む）を
  //   // dishes.txtに書き込む
  //   fwrite($fh, "The price of $row[0] is $row[1] \n");
  // }
  // fclose($fh);

  // 「dishes.csv」というCSVファイルが送られてくることをWebクライアントに通知する。
  header('Content-Type: text/csv'); // CSVファイルに備えるようにWebクライアントに通知する
  header('Content-Disposition: attachment; filename="dishes.csv"'); // CSVファイルを別のプログラムで表示するようにWebクライアントに通知する

  // CSVデータの取得
  // $fh = fopen('dishes.csv', 'rb');
  // $fh2 = fopen('dishes2.csv', 'wb');
  $csv_file = 'dishes.csv';
  if(is_readable($csv_file)) {
    $fh2 = fopen('dishes.csv', 'rb');
    if($fh2) {
      // 出力ストリームへのファイルハンドルを開く
      $fh = fopen('php://output', 'wb');
      // while((!feof($fh)) && ($info = fgetcsv($fh))) {
      while((!feof($fh2)) && ($info = fgetcsv($fh2))) {
        // $info[0]は料理名(dishes.csvの行の最初のフィールド)
        // $info[1]は値段(2番目のフィールド)
        // $info[2]は辛さ(3番目のフィールド)
        // print "Inserted $info[0], $info[1], $info[2]</br>";
        // fputcsv($fh2, [$info[0], $info[1], $info[2]]);
        fputcsv($fh, [$info[0], $info[1], $info[2]]);
      }
      // ファイルを閉じる
      // fclose($fh);
      if(!fclose($fh2)) {
        print "Error closing dishes.txt: $php_errormg";
      }
    } else {
      print "Error opening dishes.txt: $php_errormg";
    }
  } else {
    print "Can`t read template file.";
  }
 ?>
