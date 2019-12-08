<?php
include 'restaurant-functions.php';

class RestaurantCheckTest extends PHPUnit_Framework_TestCase {

  public function testWithTaxAndTip() {
    $meal = 100;
    $tax = 10;
    $tip = 20;
    $result = restaurant_check($meal, $tax, $tip);
    $this->asserEquals(130, $result);
  }
  
}
 ?>
