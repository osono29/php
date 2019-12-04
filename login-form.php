<?php
  require 'helperClass.php';
  session_start();

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

  // 独自のデフォルトはないので、
  // FormHelperコンストラクタに何も渡さない
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
    Username: {$form->input('text', ['name' => 'username'])} <br/>
    Password: {$form->input('password', ['name' => 'password'])} <br/>
    {$form->input('submit', ['value' => 'Log In'])}
  </form>
  _FORM_;

  function validate_form() {
    $input = array();
    $errors = array();

    // ユーザ名とパスワードのサンプル
    $user = array('alice' => 'dog123',
                  'bob' => 'my^pwd',
                  'charlie' => '**fun**');

    // ユーザ名が有効であることを確認する
    $input['username'] = $_POST['username'] ?? '';
    if(!array_key_exists($input['username'], $users)) {
      $errors[] = 'Please enter a valid username and password.';
    }
    // このelse句は無効なユーザ名を入力した場合に
    // パスワードをチェックしないようにする
    else {
      // パスワードが正しいかどうかを確認する
      $saved_password = $users[$input['username']];
      $submitted_password = $_POST['password'] ?? '';
      if($saved_password != $submitted_password) {
        $errors[] = 'Please enter a valid username and password.';
      }
    }
    return array($errors, $input);
  }

  function process_form($input) {
    // セッションにユーザ名を追加する
    $_SESSION['username'] = $input['username'];

    print "Welcome, $_SESSION[username]";
  }

  // ログアウト
  session_start();
  unset($_SESSION['username']);

  print 'Bye-bye.';
 ?>
