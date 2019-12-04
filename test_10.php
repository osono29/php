<?php
  // // クッキーに名前「userId」値「ralph」をセット
  // setcookie('userId', 'ralph');
  // // クッキーの「userId」の値を取得
  // print 'Hello, ' . $_COOKIE['userId'];
  // // このクッキーは今から1時間後に有効期限が切れる
  // setcookie('short-userid', 'ralph', time() + 60 * 60);
  // // このクッキーは今から1日後に有効期限が切れる
  // setcookie('longer-userid', 'ralph', time() + 60 * 60 * 24);
  // // このクッキーは2019年10月1日の正午に有効期限が切れる
  // $d = new DateTime("2019-10-01 12:00:00");
  // setcookie('much-longer-userid', 'ralph', $d->format('U'));
  // // クッキーパスの設定
  // // サーバへの全ての（ルートディレクトリ以下）リクエストでこのクッキーを送り返す
  // setcookie('short-userid', 'ralph', 0, '/');
  // // 「http://students.example.edu/~alice/」以下へのリクエストでこのクッキーを送り返す
  // setcookie('short-userid', 'ralph', 0, '/~alice/');
  // // クッキードメインの設定
  // // 「.example.com」で終わる全てのサーバ名の任意のディレクトリ（パスが/であるため）へのリクエストで送り返す
  // setcookie('short-userid', 'ralph', 0, '/', '.example.com');
  // // 24時間で有効期限が切れ、パスやドメインの制限がなく、安全な接続（URLがhttpsで始まる接続）
  // // のみで送り返され、クライアントサイドJavaScriptでは利用できない(第7引数)クッキー
  // setcookie('short-userid', 'ralph', 0, null, null, true, true);
  //
  // // クッキーの削除
  // setcookie('short-userid', '');

  // セッションへのフォームデータの保存
  require 'helperClass.php';

  session_start();

  $main_dishes = array('cuke' => 'Braised Sea Cucumber',
                       'stomach' => "Sauteed Pig's Stomach",
                       'tripe' => 'Sauteed Tripe with Wine Sauce',
                       'taro' => 'Stewed Pork with Taro',
                       'giblets' => 'Baked Giblets with Salt',
                       'abalone' => 'Abalone with Marrow and Duck Feet');

  if($_SERVER['REQUEST_METHOD'] == 'POST') {
    list($errors, $input) = validate_form();
    if($errors) {
      show_form($errors);
    } else {
      process_form($input);
    }
  } else {
    show_form();
  }

  function show_form($errors = array()) {
    // 独自のデフォルトはないので、
    // FormHelperコンストラクタには何も渡さない
    $form = new FormHelper();

    // 後に使うエラーHTMLを作成する
    if($errors) {
      $errorHtml = '<ul><li>';
      $errorHtml .= implode('</li><li>', $errors);
      $errorHtml .= '</li></ul>';
    } else {
      $errorHtml = '';
    }

    print <<< _FORM_
    <form method="POST" action="{$form->encode($_SERVER['PHP_SELF'])}">
      $errorHtml
      Dish: {$form->select($GLOBALS['$main_dishes'], ['name' => 'dish'])} <br/>

      Quantity: {$form->input('text', ['name' => 'quantity'])} <br/>

      {$form->input('submit', ['value' => 'Order'])}
    </form>
    _FORM_;
  }

  function validate_form() {
    $input = array();
    $errors = $array();

    // メニューから選択した料理は適正でなければいけない
    $input['dish'] = $_POST['dish'] ?? '';
    if(!array_key_exists($input['dish'], $GLOBALS['$main_dishes'])) {
      $errors[] = 'Please select a valid dish.';
    }

    $input['quantity'] = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT,
                                      array('options' => array('min_range' => 1)));
    if(($input['quantity'] === false) || ($input['quantity'] === null)) {
      $errors[] = 'Please enter a quantity.';
    }
    return array($errors, $input);
  }

  function process_form($input) {
    $_SESSION['order'][] = array('dish' => $input['dish'],
                                 'quantity' => $input['quantity']);
    print 'Thank you for your order.';
  }

  // セッションデータの出力
  session_start();

  $main_dishes = array('cuke' => 'Braised Sea Cucumber',
                       'stomach' => "Sauteed Pig's Stomach",
                       'tripe' => 'Sauteed Tripe with Wine Sauce',
                       'taro' => 'Stewed Pork with Taro',
                       'giblets' => 'Baked Giblets with Salt',
                       'abalone' => 'Abalone with Marrow and Duck Feet');

  if(isset($_SESSION['order']) && (count($_SESSION['order']) > 0)) {
    print '<ul>';
    foreach($_SESSION['order'] as $order) {
      $dish_name = $main_dishes[$order['dish']];
      print "<li> $order[quantity] of $dish_name </li>";
    }
    print "</ul>";
  } else {
    print "You haven`t ordered anything.";
  }

  // 許容セッションアイドル時間の変更
  ini_set('session.gc_maxlifetime', 600); // 600秒 == 10分
  session_start();

  // 有効期限切れセッションを削除する確率の変更
  ini_set('session.gc_probability', 100); // 100%：リクエストのたびに削除する
  session_start();
 ?>
