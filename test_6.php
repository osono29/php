<?php

class Entree {
  // プロパティ
  public $name;
  public $ingredients = array();

  // コンストラクタ
  public function __construct($val1, $val2) {
    if(!is_array($val2)) {
      throw new Exception('$val2 must be an array');
    }
    $this->name = $val1;
    $this->ingredients = $val2;
  }

  // メソッド
  public function hasIngredient($ingredient) {
    return in_array($ingredient, $this->ingredients);
  }

  // 静的メソッド
  public static function getSizes() {
    return array('small', 'medium', 'large');
  }
}

// インスタンス生成
$a = new Entree;

//  $aのプロパティ設定
$a->name = 'osono';
$a->ingredients = ['a', 'b'];

// $aのメソッド使用
$a->hasIngredient('a'); // true or false

// 静的メソッド呼び出し
$b = Entree::getSizes();

// コンストラクタの呼び出し
$c = new Entree('a', ['b', 'c']);

// 例外処理
try {
  $drink = new Entree('Glass of Milk', 'milk');
  if($drink->hasIngredient('milk')) {
    print "Yummy!";
  } catch(Exception $e) {
    print "Couldn`t create the drink: " . $e->getMessage(); // Couldn`t create the drink: $val2 must be an array
  }
}

// Entreeのサブクラス
class ComboMeal extends Entree {
  public function __construct($name, $entrees) {
    // サブクラスのコンストラクタは親クラスのコンストラクタを明示的に呼び出す必要がある
    parent:: __construct($name, $entrees); // $entreesを配列かチェックして、プロパティセット
    foreach($entrees as $entree) {
      if(!$entree instanceof Entree) { // $entreeがEntreeオブジェクトかチェック
        throw new Exception('Elements of $entrees must be Entree objects');
      }
    }
  }

  public function hasIngredient($ingredient) {
    foreach($this->ingredients as $entree) {
      if($entree->hasIngredient($ingredient)) {
        return true;
      }
    }
    return false;
  }
}

// ------------------

namespace Nikumen;

class Ingredient {
  protected $name;
  protected $cost;

  public function __construct($name, $cost) {
    $this->name = $name;
    $this->cost = $cost;
  }

  public function getName() {
    return $this->name;
  }

  public function getCost() {
    return $this->cost;
  }

  public function setCost($newCost) {
    $this->cost = $newCost;
  }
}

class allCost extends Entree {
  public function __construct($name, $ingredients) {
    parent:: __construct($name, $ingredients);
    foreach($this->ingredients as $ingredient) {
      if(!$ingredient instanceof ¥Nikumen¥Ingredient) {
        throw new Exception('NooooooooooO!!');
      }
    }
  }

  public function getTotalCost() {
    $cost = 0;
    foreach($this->ingredients as $ingredient) {
      $cost += $ingredient->getCost;
    }
    return $cost;
  }
}

 ?>
