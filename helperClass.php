<?php
class FormHelper {
  protected $values = array();

  public function __construct($values = array()) {
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
      $this->values = $_POST;
    } else {
      $this->values = $values;
    }
  }

  public function input($type, $attributes = array(), $isMultiple = false) {
    $attributes['type'] = $type;
    if(($type == 'radio') || ($type == 'checkbox')) {
      if($this->isOptionSelected($attributes['name'] ?? null,
                                 $attributes['value'] ?? null)) {
        $attributes['checked'] = true;
      }
    }
    return $this->tag('input', $attributes, $isMultiple);
  }

  public function select($options, $attributes = array()) {
    $multiple = $attributes['multiple'] ?? false;
    return
      $this->start('select', $attributes, $multiple).
      $this->options($attributes['name'] ?? null, $options).
      $this->end('select');
  }

  public function textarea($attributes = array()) {
    $name = $attributes['name'] ?? null;
    $value = $this->values[$name] ?? '';
    return $this->start('textarea', $attributes).
           htmlentities($value).
           $this->end('textarea');
  }

  public function tag($tag, $attributes = array(), $isMultiple = false) {
    return "<$tag {$this->attributes($attributes, $isMultiple)} />";
  }

  public function start($tag, $attributes = array(), $isMultiple = false) {
    // <select>と<textarea>タグは値属性を持たない
    $valueAttribute = (! (($tag == 'select') || ($tag == 'textarea')));
    $attrs = $this->attributes($attributes, $isMultiple, $valueAttribute);
    return "<$tag $attrs>";
  }

  public function end($tag) {
    return "</$tag>";
  }

  protected function attributes($attributes, $isMultiple, $valueAttribute = true) {
    $tmp = array();
    // このタグに値属性を指定することができ、
    // タグが名前を持ち、値配列にその名前のエントリがあれば、
    // 値属性を設定する
    if($valueAttribute && isset($attributes['name']) &&
       array_key_exists($attributes['name'], $this->values)) {
       $attributes['value'] = $this->values[$attributes['name']];
    }
    foreach($attributes as $k => $v) {
      // 真偽値trueはブール属性を意味する
      if(is_bool($v)) {
        if($v) {$tmp[] = $this->encode($k);}
      }
      // それ以外なら k=v
      else {
        $value = $this->encode($v);
        // これが複数の値を持つことができる要素の場合、
        // 名前に[]を付ける
        if($isMultiple && ($k == 'name')) {
          $value .= '[]';
        }
        $tmp[] = "$k=¥"$value¥"";
      }
    }
    return implode(' ', $tmp);
  }

  protected function options($name, $options) {
    $tmp = array();
    foreach($options as $k => $v) {
      $s = "<option value=¥"{$this->encode($k)}¥"";
      if($this->isOptionSelected($name, $k)) {
        $s .= ' selected';
      }
      $s .= ">{$this->encode($v)}</option>";
      $tmp[] = $s;
    }
    return implode('', $tmp);
  }

  protected function isOptionSelected($name, $value) {
    // 値配列に$nameのエントリがなければ、
    // このオプションは選択できない
    if(!isset($this->values[$name])) {
      return false;
    }
    // それ以外なら、$valueと値配列の$nameのエントリを比較する
    else {
      return $value == $this->values[$name];
    }
  }

  public function encode($s) {
    return htmlentities($s);
  }
}
?>
