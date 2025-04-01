<?php
session_start();
 ob_start();
     echo $_POST['village'];
     echo $_POST['country'];
     echo $_POST['pincode'];

//  echo "seller".$_POST['sellerpincode'];
 if($_POST['village']==""){
     if(true){
      //header('Location:../checkout.php?messageid=Pincode is not Delivereble');
      //echo "pincode not match";
 }
}
 else
 {
$haystack = $_POST['village'];   
$needle   = $_POST['pincode'];
if(!str_contains($haystack, $needle)) {
    //header('Location:../checkout.php?messageid=Pincode is not Delivereble');
}
}

//($_SESSION['decoded']);
$currentTime = time();
// if($decoded->exp>$curre
$decoded = $_SESSION['decoded']; 
if (empty($_COOKIE['user_cart']) || intval($decoded->exp) < $currentTime || empty($decoded->data->email)) {
    unset($_SESSION['decoded']);

    //header("Location: ../shop.php");
}

require('../constant.php');
require('razorpay-php/Razorpay.php');
$host = "localhost";
$dsn = 'mysql:host=localhost;dbname=mangodb';
$db_name = "mangodb";
$username = "root";
$password = "";
$conn;
$shippingC=0;
$discount=0;
$result = json_decode($_COOKIE['user_cart'], true);
$customIndex = 0;
foreach ($result as $index => $order) {
    $shippingC= $order['shipping'];
  }
$subTotal = 0;
$orderTotal = 0;
$sgstItem = 0;
$cgstItem = 0;
$_SESSION['user_address'] = isset($_POST['address']) ? $_POST['address'] : "";
$_SESSION['user_notes'] = isset($_POST['notes']) ? $_POST['notes'] : "";
$_SESSION['user_address_type'] = isset($_POST['listGroupRadios']) ? $_POST['listGroupRadios'] : "";
$_SESSION['user_save_address'] = $saveAddr = isset($_POST['saveAddress']) ? $_POST['saveAddress'] : "";
$pdo = new PDO($dsn, $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// Create the Razorpay Order


use Razorpay\Api\Api;

$result = json_decode($_COOKIE['user_cart'], true);
//print_r($result);
$orderId = $_SESSION['user_order_id'] = "ORD_" . time() . rand(1000, 9999);
foreach ($result as $index => $order) {

    $pid = trim($order["pid"]);
    $catId = trim($order["catId"]);

     $query1 = "Select a.name,a.id,a.categoriesId, a.subCategoryId,a.description,b.quantity,a.createdOn,a.image,
    a.sellerId,d.sellerName,a.skuId,a.price,a.shippingCharge,a.discount,c.sgst,c.cgst,a.adminCommision from products as a
    INNER JOIN productskuid  as b ON b.productId=a.id JOIN 
    seller  as d ON a.sellerId=d.id JOIN categories as c ON a.categoriesId=c.id where a.categoriesId=:catId and a.id=:pid ";

    $stmt1 = $pdo->prepare($query1);
    $stmt1->bindParam(':catId', $catId);
    $stmt1->bindParam(':pid', $pid);
    $stmt1->execute();
    $results1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
    //print_r($results1);
    $counts=$results1[0]['quantity'];
     //echo "<br><br>";
    //print_r($order);

    if ($order['quantity'] <= $counts) {
        $total = floatval(($results1[0]['price']) * ($order['quantity']));
       
        $subTotal = floatval($total-($total*$results1[0]['discount']*0.01));
      
        $sgstItem = floatval($subTotal * $results1[0]['sgst'] * 0.01);
       
        $cgstItem = floatval($subTotal * $results1[0]['cgst'] * 0.01);
        
        $updatedBy = "Admin";
        $updatedOn = time();
         //echo "-----".$subTotal;
        $orderTotal =floatval($orderTotal+(float)$subTotal+(float)$sgstItem+(float)$cgstItem);
        $quantity = $results1[0]['quantity'] - intval($order['quantity']);

    } else {

        //header('Location:../cart.php?msg='.$counts.'&pid='.$pid );
        break;

    }
   


}
//echo "<br>". $orderTotal ;
$api = new Api($keyId, $keySecret);

$name = $decoded->data->name;
$email = $decoded->data->email;
$contact = $_SESSION['phoneNo'];//($_POST['contact']!=""||is_nan($_POST['contact']))?$_POST['contact']:9999999999;
$address = "ONLINE SABJI MANDI";
$merchant_order_id = $orderId;//$_POST['registration_no'];
 $amtx=($orderTotal+floatval($shippingC))*100;
 $amt =intval($amtx); 

$orderData = [
    'receipt' => $merchant_order_id,
    'amount' => $amt, // 2000 rupees in paise
    'currency' => $curreny,
    'payment_capture' => 1 // auto capture
];


$razorpayOrder = $api->order->create($orderData);

$razorpayOrderId = $razorpayOrder['id'];

$_SESSION['razorpay_order_id'] = $razorpayOrderId;

$displayAmount = $amount = $orderData['amount'];

if ($displayCurrency !== 'INR') {
    $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
    $exchange = json_decode(file_get_contents($url), true);

    $displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
}

$checkout = 'success';
unset($_SESSION['userpincode']);
$data = [
    "key" => $keyId,
    "amount" => $amount,
    "name" => $APP_NAME,
    "description" => $appDesc,
    "image" => $appImg,
    "prefill" => [
        "name" => $name,
        "email" => $email,
        "contact" => $contact,
    ],
    "notes" => [
        "address" => $address,
        "merchant_order_id" => $merchant_order_id,
    ],
    "theme" => [
        "color" => "#F37254"
    ],
    "order_id" => $razorpayOrderId,
];

if ($displayCurrency !== 'INR') {
    $data['display_currency'] = $displayCurrency;
    $data['display_amount'] = $displayAmount;
}

//  $json = json_encode($data);



//setcookie('user_cart', '', time() - 3600, "/");
if ($saveAddr == "yes") {
    $_SESSION['address1'] = $_POST['addrs1'];
    $_SESSION['address2'] = $_POST['addrs2'];
    $_SESSION['city'] = $_POST['city'];
    $_SESSION['state'] = $_POST['state'];
    $_SESSION['postalCode'] = $_POST['postalCode'];
    $_SESSION['phone'] = $_POST['phone'];
    $_SESSION['landmark'] = $_POST['landmark'];
}
if ($_POST['listGroupRadios'] == "online") {
    require("{$checkout}.php");


} elseif ($_POST['listGroupRadios'] == 'cod') {

    foreach ($result as $index => $order) {
        $pid = trim($order["pid"]);
        $catId = trim($order["catId"]);


        $query = "Select a.name,a.id,a.categoriesId, a.subCategoryId,a.description,b.quantity,a.createdOn,a.image,
  a.sellerId,d.sellerName,a.skuId,a.price,a.shippingCharge,a.discount from products as a
    INNER JOIN productskuid  as b ON b.productId=a.id JOIN 
seller  as d ON a.sellerId=d.id where a.categoriesId=:catId and a.id=:pid ";

        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':catId', $catId);
        $stmt->bindParam(':pid', $pid);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $total = $total + ($results[0]['price'] * $order['quantity']);


        $queryInsertItem = "INSERT INTO
      
orderitem 
SET      userId=:userId,orderId=:orderId,productId=:productId,productSkuId=:productSkuId,
quantity=:quantity,discount=:discount,  price=:price,total=:total,
     sgst=:sgst,cgst=:cgst, createdBy=:createdBy,createdOn=:createdOn";



        $sgst = $total * $SGST * 0.01;
        $cgst = $total * $CGST * 0.01;

        $stmt1 = $pdo->prepare($queryInsertItem);
        $stmt1->bindParam(":userId", $userId);
        $stmt1->bindParam(":orderId", $orderId);
        $stmt1->bindParam(":productId", $order["pid"]);
        $stmt1->bindParam(":productSkuId", $order['pSkuid']);

        $stmt1->bindParam(":quantity", $order["quantity"]);
        $stmt1->bindParam(":discount", $results[0]['discount']);
        $stmt1->bindParam(":price", $results[0]['price']);
        $stmt1->bindParam(":total", $total, PDO::PARAM_STR);

        $stmt1->bindParam(":cgst", $cgst, PDO::PARAM_STR);
        $stmt1->bindParam(":sgst", $sgst, PDO::PARAM_STR);
        $stmt1->bindParam(":createdBy", $userId);
        $stmt1->bindParam(":createdOn", $createdOn);

        $stmt1->execute();
    }


    $insertOrderDetails = "INSERT INTO
    orderdetails
SET      userId=:userId, orderId=:orderId,paymentId=:paymentId,sellerId=:sellerId,status=:status,
         adminCommision=:adminCommision, deliveryAddress=:address,deliveryInstruction:deliveryInstruction 
             createdBy=	:createdBy, createdOn=:createdOn,total=:total";
    $stmt2 = $pdo->prepare($insertOrderDetails);
    $stmt2->bindParam(":userId", $userId);
    $stmt2->bindParam(":sellerId", $sellerId);
    $stmt2->bindParam(":orderId", $orderId);
    $stmt2->bindParam(":paymentId", $paymentId);
    $stmt2->bindParam(":total", $total);
    $stmt2->bindParam(":deliveryAddress", $deliveryAddress);
    $stmt2->bindParam(":adminCommision", $adminCommision);
    $stmt2->bindParam(":createdBy", $userId);
    $stmt2->bindParam(":status", $orderStaus);
    $stmt2->bindParam(":deliveryInstruction", $deliveryInstruction);
    $stmt2->bindParam(":createdOn", $createdOn);
    $stmt2->execute();

    setcookie('user_cart', '', time() - 3600, "/");

    echo '
    <form action="reciept.php" id="yourform" method="POST">
        <input type="hidden" name="roi" value="' . $orderId . '">
         <input type="hidden" name="rpi" value="' . $paymentId . '">
          <input type="hidden" name="rs" value="GLINTEL">
    </form>
<script>            
document.addEventListener("DOMContentLoaded", function(event) {
        document.createElement(
            "form").submit.call(document.getElementById("yourform"));
        });         
</script>
';
unset($_SESSION['userpin']);

} else {
    header('Location:../account.php');
}
ob_end_flush();