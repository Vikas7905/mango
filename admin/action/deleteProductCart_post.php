<?php
include '../../constant.php';

echo $id= $_GET["id"];

if (isset($_COOKIE["user_cart"])) {
  $orders = isset($_COOKIE['user_cart']) ? json_decode($_COOKIE['user_cart'], true) : [];


foreach ($orders as $index => $order) {

  if ($index== $id) {
    echo $index;
    unset($orders[$index]);
  }}
  //setcookie('user_cart', '', time() - 3600, "/");
  //setcookie('user_cart', json_encode($orders), time() + (86400 * 30), "/"); // Cookie valid for 30 days

}

print_r($_COOKIE["user_cart"]);
//  print_r($result->token);

?>
