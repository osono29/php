<?php
// helperClass.phpがこのファイルと
// 同じディレクトリにあることを前提とする
require 'helperClass.php';

// セレクトメニューに選択肢の配列を用意する
// これからはdisplay_form()、validate_form(),
// process_form()で必要なので、グローバルスコープで宣言する
$sweets = array('puff' => 'Sesame Seed Puff',
                'square' => 'Coconut Milk Gelatin Square',
                'cake' => 'Brown Sugar Cake',
                'ricemeat' => 'Sweet Rice and Meat');

$main_dishes = array('cuke' => 'Braised Sea Cucumber',
                     'stomach' => "Sauteed Pig`s Stomach",
                     'tripe' => 'Sauteed Tripe with Wine Sauce',
                     'taro' => 'Stewed Pork with Taro',
                     'giblets' => 'Baked Giblets with Salt',
                     'abalone' => 'Abalone with Marrow and Duck Feet');

// メインページのロジック：
// - フォームがサブミットされたら、検証して処理するかまたは再表示する
// - フォームがサブミットされなかったら表示する
if($_SERVER['REQUEST_METHOD'] == 'POST') {
  // validate_form()がエラーを返したら、エラーをshow_form()に渡す
  list($errors, $input) = validate_form();
  if($errors) {
    show_form($error);
  } else {
    // サブミットされたデータが有効なら処理する
    process_form($input);
  }
} else {
  // フォームがサブミットされなかったので、表示する
  show_form();
}

function show_form($errors = array()) {
  $defaults = array('delivery' => 'yes', 'size' => 'medium');
  // 適切なデフォルトで$formを用意する
  $form = new FormHelper($defaults);
  // 全てのHTMLとフォーム表示をわかりやすくするため個別のファイルに入れる
  include 'complete-form.php';
}

function validate_form() {
  $input = array();
  $errors = array();

  // nameが必要
  $input['name'] = trim($_POST['name'] ?? '');
  if(!strlen($input['name'])) {
    $errors[] = 'Please enter your name.';
  }
  // sizeが必要
  $input['size'] = $_POST['size'] ?? '';
  if(!in_array($input['size'], ['small','medium','large'])) {
    $errors[] = 'Please select a size.';
  }
  // sweetが必要
  $input['sweet'] = $_POST['sweet'] ?? '';
  if(!array_key_exists($input['sweet'], $GLOBALS['sweets'])) {
    $errors[] = 'Please select a valid sweet item.';
  }
  // ちょうど2つのメインディッシュが必要
  $input['main_dish'] = $_POST['main_dish'] ?? array();
  if(count($input['main_dish']) != 2) {
    $errors[] = 'Please select exactly two main dishes.';
  } else {
    // 2つのメインディッシュが選択されたことがわかるので、
    // どちらも有効であることを確認する
    if(!(array_key_exists($input['main_dish'][0], $GLOBALS['main_dishes']) &&
         array_key_exists($input['main_dish'][1], $GLOBALS['main_dishes']))) {
           $errors[] = 'Please select exactly two valid main dishes.';
    }
  }
  // deliveryがチェックされていたら、コメントに何かが含まれる
  $input['delivery'] = $_POST['delivery'] ?? 'no';
  $input['comments'] = trim($_POST['comments'] ?? '');
  if(($input['delivery'] == 'yes') && (!strlen($input['comments']))) {
    $errors[] = 'Please enter your address for delivery.';
  }
  return array($errors, $input);
}

function process_form($input) {
  // $GLOBALS['sweets']と$GLOBALS['main_dishes']配列から
  // スイーツとメインディッシュの正式名称を探す
  $sweet = $GLOBALS['sweets'][$input['sweet']];
  $main_dish_1 = $GLOBALS['main_dishes'][$input['main_dish'][0]];
  $main_dish_2 = $GLOBALS['main_dishes'][$input['main_dish'][1]];
  if(isset($input['delivery']) && ($input['delivery'] == 'yes')) {
    $delibery = 'do';
  } else {
    $delivery = 'do not';
  }
  // 注文メッセージのテキストを作成する
  $message = <<< _ORDER_
Thank you for your order, {$input['name']}.
You requested the {$input['size']} size of $sweet, $main_dish_1, and $main_dish_2.
You $delivery want delivery.
_ORDER_;
  if(strlen(trim($input['comments']))) {
    $message .= 'You comments: '. $input['comments'];
  }

  // メッセージをシェフに送る
  mail('chef@restaurant.example.com', 'New Order', $message);
  // メッセージを出力するが、HTMLエンティティにエンコードし、
  // 改行を<br/>タグに変える
  print nl2br(htmlentities($message, ENT_HTML5));
}
 ?>
