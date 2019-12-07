<?php
  print 'Did you know that ' . file_get_contents('http://numbersapi.com/09/27') . '<br/>';
  print 'http://example.com?' . http_build_query(['osono' => 'takuma','abe' => 'marie']) . '<br/>';

  // APIキーを定数に設定
  define('NDB_API_KEY', 'ucs3FE00wr6d6UklDuLunJYWlSsD0KKV9StpWaW8');

  $params = array('api_key' => NDB_API_KEY,
                  'q' => 'black pepper',
                  'format' => 'json');
  $url = "http://api.nal.usda.gov/ndb/search?" . http_build_query($params);
  $response = file_get_contents($url);
  // print $response . <br/>;
  $info = json_decode($response);

  // foreach ($info->list->item as $item) {
  //   print "The ndbno for {$item->name} is {$item->ndbno} . <br/>";
  // }

  // ストリームコンテキストを使ったHTTPヘッダの送信
  // クエリ文字列ではキーとクエリ用語だけを指定してフォーマットは指定しない
  $params = array('api_key' => NDB_API_KEY,
                  'q' => 'black pepper');
  $url = "http://api.nal.usda.gov/ndb/search?" . http_build_query($params);

  // オプションはContent-Typeリクエストヘッダに設定する
  $options = array('header' => 'Content-Type: application/json');
  // 「http」ストリームのコンテキストを作成する
  $context = stream_context_create(array('http' => $options));

  // file_get_contentsへの第3引数としてコンテキストを渡す
  // print file_get_contents($url, false, $context);

  // file_get_contents()を使ったPOStリクエストの送信
  $url = 'http://php7.example.com/post-server.php';
  // POSTで送る2つの変数
  $form_data = array('name' => 'black pepper',
                     'smell' => 'good');
  // メソッド、コンテンツタイプ、コンテンツを設定する
  $options = array('method' => 'POST',
                   'header' => 'Content-Type: application/x-www-form-urlencoded',
                   'content' => http_build_query('$form_data'));
  // 「http」ストリームのコンテキストを作成する
  $context = stream_context_create(array('http' => $options));

  // file_get_contentsへの第3引数としてコンテキストを渡す
  print file_get_contents($url, false, $context);

  // cURLを使ったURLの取得
  $c = curl_init('http://numbersapi.com/09/27');
  // レスポンスコンテンツをすぐに出力するのではなく
  // 文字列として返すようにcURLに通知する
  curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
  // リクエストを実行する
  $fact = curl_exec($c);

  // クエリ文字列パラメータとヘッダを設定したcURLの使用
  $params = array('api_key' => NDB_API_KEY,
                  'q' => 'black pepper');
  $url = "http://api.nal.usda.gov/ndb/search?" . http_build_query($params);

  $c = curl_init($url);
  curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($c, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
  print curl_exec($c);

  // cURLでのエラー処理
  // 存在しない偽装APIエンドポイント
  $c = curl_init('http://api.example.com');
  curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
  $result = curl_exec($c);
  // 成功の成否に関わらず全ての接続情報を取得する
  $info = curl_getinfo($c);

  // 接続に何か問題が生じた
  if($result === false) {
    print "Error #" . curl_errno($c) . "<br/>";
    print "Uh-oh! cURL says: " . curl_error($c) . "<br/>";
  }
  // 400台と500台のHTTPレスポンスコードはエラーを意味する
  elseif($info['http_code'] >= 400) {
    print "The server says HTTP error {$info['http_code']}.<br/>";
  }
  else {
    print "A successful result!<br/>";
  }
  // リクエスト情報には時計統計データも含まれる
  print "By the way, this request took {$info['total_time']} seconds.<br/>";

  // cURLによるPOSTリクエストの実行
  $url = 'http://php7.example.com/post-server.php';

  // POSTで送信する2つの変数
  $form_data = array('name' => 'black pepper',
                    'smell' => 'good');
  $c = curl_init($url);
  curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
  // これはPOSTリクエストにすべき
  curl_setopt($c, CURLOPT_POST, true);
  // これは送信するデータである
  // curl_setopt($c, CURLOPT_POSTFIELDS, $form_data);
  // これはJSONを含むリクエストである
  curl_setopt($c, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
  // これは適切にフォーマットされた送信データである
  curl_setopt($c, CURLOPT_POSTFIELDS, json_encode($form_data));

  print curl_exec($c);

  // クッキーがあればクッキーで送信された値を使い、クッキーが提供されなければ0を使う
  $value = $_COOKIE['c'] ?? 0;
  // 値を1ふやす
  $value++;
  // レスポンスに新しいクッキーを設定する
  setcookie('c', $value);
  // クッキーの内容をユーザに伝える
  print "Cookies: " . count($_COOKIE) . "<br/>";
  foreach($_COOKIE as $k => $v) {
    print "$k: $v<br/>";
  }

  // cURLのデフォルトのクッキー処理
  $c = curl_init('http://php7.example.com/cookie-server.php');
  curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
  // 1回目にはクッキーはない
  $res = curl_exec($c);
  print $res;

  // 2回目もやはりクッキーはない
  $res = curl_exec($c);
  print $res;

  // cURLのクッキーjarの有効化
  $c = curl_init('http://php7.example.com/cookie-server.php');
  curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
  // クッキーjarを有効にする
  curl_setopt($c, CURLOPT_COOKIEJAR, true);

  // 1回目にはクッキーはない
  $res = curl_exec($c);
  print $res;
  // 2回目は最初のリクエストからのクッキーがある
  $res = curl_exec($c);
  print $res;

  // リクエスト間でのクッキーの追跡
  // クッキーサーバページを取得する
  $c = curl_init('http://php7.example.com/cookie-server.php');
  curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
  // このプログラムと同じディレクトリの「saved.cookies」ファイルに
  // クッキーを保存する
  curl_setopt($c, CURLOPT_COOKIEJAR, __DIR__ . '/sabed.cookies');
  // このディレクトリの「saved.cookies」から
  // クッキーを読み込む（以前に保存されている場合）
  curl_setopt($c, CURLOPT_COOKIEFILE, __DIR__ . '/saved.cookies');

  // このリクエストにはファイルからのクッキーが含まれる（存在する場合）
  $res = curl_exec($c);
  print $res;

  // JSONレスポンスの提供
  $response_data = array('now' => time());
  header('Content-Type: application/json');
  print json_encode($response_data);

  // サポートしたいフォーマット
  $formats = array('application/json', 'text/html', 'text/plain');
  // 指定されなかった場合のレスポンスフォーマット
  $default_format = 'application/json';

  // レスポンスフォーマットが指定されたか
  if(isset($_SERVER['HTTP_ACCEPT'])) {
    // サポートしているフォーマットが指定されたらそれを使う
    if(in_array($_SERVER['HTTP_ACCEPT'], $formats)) {
      $format = $_SERVER['HTTP_ACCEPT'];
    }
    // サポートしていないフォーマットが指定されたのでエラーを返す
    else {
      // 406は「作成できないフォーマットでのレスポンスをリクエストしている」という意味
      http_response_code(406);
      // ここで終了するとレスポンスボディはなくなるが、問題ない
      exit();
    }
  } else {
    $format = $default_format;
  }

  // 時刻を調べる
  $respoinse_data = array('now' => time());
  // 送信するコンテンツの種類をクライアントに伝える
  header("Content-Type: $format");
  // フォーマットに適した方法で時刻を出力する
  if($format == 'application/json') {
    print json_encode($response_data);
  }
  elseif($format == 'text/html') { ?>
    <!doctype html>
      <html>
        <head><title>Clock</title></head>
        <body><time><?= date('c', $response_data['now'] ?></time></body>
      </html>
    <?php
  } elseif($format == 'text/plain') {
    print $response_data['now'];
  }

  // HTTPSのチェック
  $is_https = (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on'));
  if(!$is_https) {
    newUrl = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header("Location: $newUrl");
    exit();
  }
  print "You accessed this page over HTTPS. Yay!";
 ?>
