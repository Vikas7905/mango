<?php 
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {

  $userId = isset($_SESSION['email'])?$_SESSION['email']:"Guest";
  $price = $_POST["price"];
  $pname = $_POST["pname"];
  $productSkuid = $_POST["productSKUID"];
  $productId = $_POST["productId"];
  $sellerId = $_POST["sellerId"];
  $quantity = $_POST["quantity"];
  $createdOn = date('Y-m-d h:i:sa');
  $discount = $_POST["discount"];
  $shipping = $_POST['shipping'];
  $catId = $_POST['catId'];
  $sgst = $_POST['sgst'];
  $cgst = $_POST['cgst'];
  $sellerName = $_POST['sellerName'];
  $afterDis= number_format($quantity * $price- $quantity * $price*0.01* $discount,2);
$tax=number_format(($afterDis*$sgst*0.01)+($afterDis*$cgst*0.01));

$data = array(
    "pid" => $productId,
    "pSkuid" => $productSkuid,
    "productName" => $pname,
    "quantity" => $quantity,
    "price" => $price,
    "sellerId" => $sellerId,
    "sellerName"=>$sellerName,
    "itemTotal" =>  $afterDis,
    "discount" => $discount,
    "shipping" => $shipping,
    "tax"=>$tax,
    "catId" => $catId,
    "sgst"=>$sgst,
    "cgst"=>$cgst
  );

  $cart = isset($_COOKIE['user_cart']) ? json_decode($_COOKIE['user_cart'], true) : [];

  $result = searchUserByName($cart, $productId);

  if ($result->validation) {
    setcookie('user_cart', json_encode($result->orders), time() + (86400 * 30), "/"); // Cookie valid for 30 days
header('Location:../../shop.php');
  } else {

    $cart[] = $data;
    setcookie('user_cart', json_encode($cart), time() + (86400 * 30), "/"); // Cookie valid for 30 days
header('Location:../../shop.php');
  }
//   print_r($_COOKIE['user_cart']);
//   $condition = $url_param_type != "" ? ("crid=" . $url_param_type) : ("spid=" . $url_sub_param_type);

//   header('Location: ' . $_SERVER['PHP_SELF'] . "?" . $condition);
}



function searchUserByName($orders, $pid)
{
  $response = new stdClass();

  foreach ($orders as $index => $order) {

    if ($order['pid'] == $pid) {

$item_total=number_format((($order['quantity'] + $_POST["quantity"]) * $order['price'])-
($order['quantity'] + $_POST["quantity"]) * $order['price']*0.01*$_POST["discount"],2);
      $data = array(
        "pid" => $_POST["productId"],
        "pSkuid" => $_POST["productSKUID"],
        "productName" => $_POST["pname"],
        "quantity" => $order['quantity'] + $_POST["quantity"],
        "price" => $_POST["price"],
        "sellerId" => $_POST["sellerId"],
        "itemTotal" => $item_total,
        "discount" => $_POST["discount"],
        "shipping" => $_POST["shipping"],
        "catId" => $_POST["catId"],
        "sellerName"=> $_POST["sellerName"],
        "sgst"=>$_POST["sgst"],
        "cgst"=>$_POST["cgst"],
        "tax"=>number_format(($item_total*0.01*$_POST["sgst"])+($item_total*0.01*$_POST["sgst"]),2)
      );

      unset($orders[$index]);
      array_push($orders, $data);
      $response->orders = $orders;
      $response->validation = true;
      // Return the user object if found
      return $response;
    }
  }
  return $response->validation = false;
}



?>