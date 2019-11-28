<?php
if('POST' == $_SERVER['REQUEST_METHOD']) {
  print "Hello, ". $_POST['my_name']. '<br>';
  print "REQUEST_METHOD : ". $_SERVER['REQUEST_METHOD']. '<br>';
  print "PHP_SELF : ". $_SERVER['PHP_SELF']. '<br>';
  print "SCRIPT_NAME : ". $_SERVER['SCRIPT_NAME']. '<br>';
  print "Your name (strip_tags) : ". strip_tags($_POST['my_name']). '<br>';
  print "Your name (htmlentities) : ". htmlentities($_POST['my_name']). '<br>';
} else {
  print <<< _HTML_
<form method="post" action="$_SERVER[PHP_SELF]">
  Your name: <input type="text" name="my_name" >
<br>
<input type="submit" value="Say Hello">
</form>
_HTML_;
}
?>

<!-- <form method="POST" action="test_7.php">
  product_id : <input type="text" name="product_id">
  <br/>
  category : <select name="category">
    <option value="ovenmitt">Pot Holder</option>
    <option value="fryingpan">Frying Pan</option>
    <option value="torch">Kitchen Torch</option>
  </select>
  <br/>
  lunch : <select name="lunch[]" multiple>
    <option value="pork">BBQ Pork Bun</option>
    <option value="chicken">Chicken Bun</option>
    <option value="lotus">Lotus Seed Bun</option>
    <option value="bean">Bean Paste Bun</option>
    <option value="nest">Bird-Nest Bun</option>
  </select>
  <input type="submit" name="submit">
</form>
Here are the submitted values:
<br/>
product_id : <?php print $_POST['product_id'] ?? '' ?>
<br/>
category : <?php print $_POST['category'] ?? '' ?>
<br/>
lunch :
<?php
$count = 0;
foreach($_POST['lunch'] as $lunch) {
  if($count == 0){
    print $lunch;
  } else {
    print ','. $lunch;
  }
  $count++;
}
print $str;
?> -->
