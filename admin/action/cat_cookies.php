<?php
session_start();
if (isset($_POST['pid']) && isset($_POST['condition']) && $_POST['condition'] == "add") {
  $pid = $_POST['pid'];
  $pname = $_POST['pname'];
  $productSkuid = $_POST["pSkuid"];
  $quantity = $_POST['quantity'];
  $price = $_POST['price'];
  $itemTotal = $_POST['itemTotal'];
  $subTotal = $_POST['subTotal'];
  $tax = $_POST['tax'];
  $totalAmt = $_POST['totalAmt'];
  $discount = $_POST['discount'];
  $shipping = $_POST['shipping'];
  $cgst = $_POST["cgst"];
  $sgst = $_POST["sgst"];
  $seller = $_POST["sellerName"];

  $cData = array(
    "pid" => $pid,
    "pSkuid" => $productSkuid,
    "productName" => $pname,
    "quantity" => $quantity,
    "price" => $price,
    "itemTotal" => $itemTotal,
    "subTotal" => $subTotal,
    "tax" => $tax,
    "totalAmount" => $totalAmt,
    "shipping" => $shipping,
    "discount" => $discount,
    "sellerName" => $seller,
    "sellerId" => $_POST['sellerId'],
    "catId" => $_POST['catId'],
    "sgst" => $sgst,
    "cgst" => $cgst
  );
  addUpdateItem($pid, $cData);

} else if (isset($_POST) && isset($_POST['condition']) && $_POST['condition'] == "remove") {
      $pid = $_POST['pid'];
  removeItem($pid);
 
} 

// Step 1: Adding items to cart
function addUpdateItem($pid, $data)
{
  $cart = isset($_COOKIE['user_cart']) ? json_decode($_COOKIE['user_cart'], true) : 0;
  $result = searchUserByName($cart, $pid);

  if ($result != "Empty" && $result != null) {

    array_push($result, $data);
    setcookie('user_cart', json_encode($result), time() + (86400 * 30), "/"); // Cookie valid for 30 days
    $_SESSION['cart']=$_COOKIE['user_cart'];
  
  } else {
    $cart = ($result == "Empty") ? [] : $result;
    $cart[] = $data;
    setcookie('user_cart', json_encode($cart), time() + (86400 * 30), "/"); // Cookie valid for 30 days
    $_SESSION['cart']=$_COOKIE['user_cart'];
  }
}

function removeItem($pid)
{

  $cart = isset($_COOKIE['user_cart']) ? json_decode($_COOKIE['user_cart'], true) : 0;

$newCart=array();
  foreach ($cart as $index => $order) {
    if ($order['pid'] === $pid) {
    }
    else{
       array_push($newCart, $order); 
    }
    
    setcookie('user_cart', json_encode($newCart), time() + (86400 * 30), "/"); // Cookie valid for 30 days
    $_SESSION['cart']=$_COOKIE['user_cart'];
  }


}

function searchUserByName($orders, $pid)
{
  if (sizeof($orders) > 0) {
    foreach ($orders as $index => $order) {

      if ($order['pid'] == $pid) {
        unset($orders[$index]);
        return (sizeof($orders) > 0) ? $orders : "Empty";
      }
    }
    return $orders;
  }
  return null; // Return null if the user is not found
}

?>