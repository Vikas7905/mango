<?php
error_reporting(0);
session_start();
//$decoded=$_SESSION['decoded'];
require('../constant.php');
require('razorpay-php/Razorpay.php');
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;
$host = "localhost";
$dsn = 'mysql:host=localhost;dbname=vegitabledb';
$db_name = "vegitabledb";
$username = "root";
$password = "";
$conn;

$success = true;

//print_r($_SESSION);

$error = "Payment Failed";

$pdo = new PDO($dsn, $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$currentTime = time();
$decoded= isset($_SESSION['decoded'])?$_SESSION['decoded']:"";

$orderId = $_SESSION['user_order_id'];
$paymentId = isset($_POST['razorpay_payment_id'])?$_POST['razorpay_payment_id']:"COD";
$result = json_decode($_COOKIE['user_cart'], true);
//print_r($result);
$sellerId = "";
$userId = $decoded->data->email;
$name = $decoded->data->name;
$adminCommision = 0;
$adminCommisionTotal = 0;
$total = 0;
$orderTotal = 0;
$orderSubtotal = 0;
$sgstItem = 0;
$cgstItem = 0;
$sgstTotal = 0;
$cgstTotal = 0;
$deliveryAddress = $_SESSION['user_address'];
$notes = $_SESSION['user_notes'];
$orderStaus = "ORDER PLACED";
$createdOn = date('Y-m-d H:i:s');
$totalQuantity = 0;
if (($decoded->exp) > $currentTime && $_SESSION['user_save_address']) {
    $addrs1 = $_SESSION['address1'];
    $addrs2 = $_SESSION['address2'];
    $city = $_SESSION['city'];
    $state = $_SESSION['state'];
    $postalCode = $_SESSION['postalCode'];
    $phone = $_SESSION['phone'];
    $landmark = $_SESSION['landmark'];
    $deliveryAddress = "Name: $name <br> $addrs1 <br> $city, $state, $postalCode <br> Landmark: $landmark <br> Mobile: $phone";
    $insertOrderDetails = "INSERT INTO
address
SET userId=:userId, name=:name,mobile=:mobile,addressLine1=:addressLine1,addressLine2=:addressLine2,
 city=:city, state=:state,landmark=:landmark,postalCode=:postalCode, createdBy=	:createdBy, createdOn=:createdOn";
    $stmt2 = $pdo->prepare($insertOrderDetails);
    $stmt2->bindParam(":userId", $userId);
    $stmt2->bindParam(":name", $name);
    $stmt2->bindParam(":addressLine1", $addrs1);
    $stmt2->bindParam(":addressLine2", $addrs2);
    $stmt2->bindParam(":city", $city);
    $stmt2->bindParam(":state", $state);
    $stmt2->bindParam(":postalCode", $postalCode);
    $stmt2->bindParam(":mobile", $phone);
    $stmt2->bindParam(":landmark", $landmark);
    $stmt2->bindParam(":createdBy", $userId);
    $stmt2->bindParam(":createdOn", $createdOn);
    $stmt2->execute();

}

if (empty($_POST['razorpay_payment_id']) === false) {
    $api = new Api($keyId, $keySecret);

    try {
        // Please note that the razorpay order ID must
        // come from a trusted source (session here, but
        // could be database or something else)

        $attributes = array(
            'razorpay_order_id' => $_SESSION['razorpay_order_id'],
            'razorpay_payment_id' => $_POST['razorpay_payment_id'],
            'razorpay_signature' => $_POST['razorpay_signature']
        );
        $pdo->beginTransaction();


        if (($decoded->exp) > $currentTime & $_SESSION['user_address_type'] == 'online') {

            foreach ($result as $index => $order) {
                //print_r($order);
                if ($order['pid'] != "") {

                    $pid = trim($order["pid"]);
                    $catId = trim($order["catId"]);
                    $quantity =trim($order["quantity"]);

                     $query = "Select a.name,a.id,a.categoriesId, a.subCategoryId,a.description,b.quantity,a.createdOn,a.image,
  a.sellerId,d.sellerName,a.skuId,a.price,a.shippingCharge,a.discount,c.sgst,c.cgst,a.adminCommision,c.commision as commision from products as a
  INNER JOIN productskuid  as b ON b.productId=a.id JOIN 
seller  as d ON a.sellerId=d.id JOIN categories as c ON a.categoriesId=c.id  where a.categoriesId=:catId and a.id=:pid ";
                    $stmt = $pdo->prepare($query);
                    $stmt->bindParam(':catId', $catId);
                    $stmt->bindParam(':pid', $pid);
                    $stmt->execute();
                    // $pdo->commit();
                    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                   //print_r($results);
                    
                     $prd_id= "PRD_" . rand(1000, 9999). time();
                     $PskuId = (floatval($results[0]['skuId']));
                     $subTotal = (floatval($results[0]['price']) * floatval($order['quantity']));
                     $total = $subTotal -($subTotal*$results[0]['discount']*0.01);
                     $adminCommision1 = (floatval($results[0]['commision'] * 0.01) * $total);
                    $adminCommisionTotal = $adminCommisionTotal + $adminCommision1;
                    $orderSubtotal = $orderSubtotal + $subTotal;
                   
                    $sgstItem = round($total * round($results[0]['sgst'] * 0.01, 2), 2);
                    $cgstItem = round($total * round($results[0]['cgst'] * 0.01, 2), 2);
                    $sgstTotal = $sgstTotal + $sgstItem;
                    $cgstTotal = $cgstTotal + $cgstItem;
                    
                    $orderTotal = round(($orderTotal + $total + $sgstItem + $cgstItem), 2);
                    $totalQuantity = $totalQuantity + $order['quantity'];
                    //echo $order['quantity'];


                      $queryInsertItem = "INSERT INTO orderitem 
SET      userId=:userId,orderId=:orderId,productId=:productId,productSkuId=:productSkuId,sellerName=:sellerName,sellerId=:sellerId,
quantity=:quantity,discount=:discount,subId=:subId, price=:price,total=:total,subTotal=:subTotal,
     sgst=:sgst,cgst=:cgst,adminCommision=:adminCommision, createdBy=:createdBy,createdOn=:createdOn";


                    $stmt1 = $pdo->prepare($queryInsertItem);
                    $stmt1->bindParam(":userId", $userId);
                    $stmt1->bindParam(":orderId", $orderId);
                    $stmt1->bindParam(":productId", $order["pid"]);
                    $stmt1->bindParam(":productSkuId", trim($order['pSkuid']));
                    $stmt1->bindParam(":sellerName", $order['sellerName']);
                    $stmt1->bindParam(":sellerId", trim($order['sellerId']));
                    $stmt1->bindParam(":subId", $prd_id);

                    $stmt1->bindParam(":quantity", $order["quantity"]);
                    $stmt1->bindParam(":discount", $results[0]['discount']);
                    $stmt1->bindParam(":price", $results[0]['price']);
                    $stmt1->bindParam(":total", $total);
                    $stmt1->bindParam(":subTotal", $subTotal);
                    $stmt1->bindParam(":adminCommision", $adminCommision1);

                    $stmt1->bindParam(":cgst", $cgstItem);
                    $stmt1->bindParam(":sgst", $sgstItem);
                    $stmt1->bindParam(":createdBy", $userId);
                    $stmt1->bindParam(":createdOn", $createdOn);
                   
                    //print_r($order);
                    $stmt1->execute();
                    //print_r($stmt1);
                    // Commit the transaction

// $pdo->commit();
 $quantity = $results[0]['quantity']-$order["quantity"];
 $queryUpdateItem = "UPDATE  productskuid 
SET  quantity=:quantity,createdBy=:createdBy,createdOn=:createdOn where productId=:productId";
  $stmt22 = $pdo->prepare($queryUpdateItem);
 $stmt22->bindParam(":quantity", $quantity );
 $stmt22->bindParam(":createdBy", $userId);
 $stmt22->bindParam(":createdOn", $createdOn);
 $stmt22->bindParam(":productId", $pid);

 $stmt22->execute();

                }
            }

            $insertOrderDetails = "INSERT INTO
        orderdetails
    SET      userId=:userId, orderId=:orderId,paymentId=:paymentId,sellerId=:sellerId,status=:status,totalQuantity=:totalQuantity,
             adminCommision=:adminCommision, deliveryAddress=:deliveryAddress,deliveryInstruction=:deliveryInstruction, 
             	sgst=:sgst,cgst=:cgst,createdBy=:createdBy, 
                createdOn=:createdOn,total=:total,subTotal=:subTotal";
            $stmt2 = $pdo->prepare($insertOrderDetails);
            $stmt2->bindParam(":userId", $userId);
            $stmt2->bindParam(":orderId", $orderId);
            $stmt2->bindParam(":paymentId", $paymentId);
            //$stmt2->bindParam(":sellerId", $sellerId);
            $stmt2->bindParam(":sellerId", trim($order['sellerId']));

            $stmt2->bindParam(":adminCommision", $adminCommision);
            $stmt2->bindParam(":deliveryAddress", $deliveryAddress);

            $stmt2->bindParam(":deliveryInstruction", $deliveryInstruction);
            $stmt2->bindParam(":sgst", $sgstTotal);
            $stmt2->bindParam(":cgst", $cgstTotal);

            $stmt2->bindParam(":status", $orderStaus);
            $stmt2->bindParam(":totalQuantity", $totalQuantity);


            $stmt2->bindParam(":adminCommision", $adminCommisionTotal);

            $stmt2->bindParam(":total", $orderTotal);
            $stmt2->bindParam(":subTotal", $orderSubtotal);
            $stmt2->bindParam(":createdBy", $userId);



            $stmt2->bindParam(":createdOn", $createdOn);

            $stmt2->execute();
            // Commit the transaction
// $pdo->commit();

         
        }
        $api->utility->verifyPaymentSignature($attributes);
    } catch (SignatureVerificationError $e) {
        $success = false;
        $error = 'Razorpay Error : ' . $e->getMessage();
       header('Location:../shop.php');
    }
}

else  if (($decode->exp) > $currentTime & $_SESSION['user_address_type'] == 'cod') {
   

    $pdo->beginTransaction();
try{

        foreach ($result as $index => $order) {
            ///print_r($order);
            if ($order['pid'] != "") {

                $pid = trim($order["pid"]);
                $catId = trim($order["catId"]);

                $query = "Select a.name,a.id,a.categoriesId, a.subCategoryId,a.description,b.quantity,a.createdOn,a.image,
a.sellerId,d.sellerName,a.skuId,a.price,a.shippingCharge,a.discount,a.sgst,a.cgst,a.adminCommision from products as a
INNER JOIN productskuid  as b ON b.productId=a.id JOIN 
seller  as d ON a.sellerId=d.id where a.categoriesId=:catId and a.id=:pid ";

                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':catId', $catId);
                $stmt->bindParam(':pid', $pid);
                $stmt->execute();
                // $pdo->commit();
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                //print_r($results);

                $subTotal = (floatval($results[0]['price']) * floatval($order['quantity']));
                $adminCommision = (floatval($adminCommision * 0.01) * $subTotal);
                $adminCommisionTotal = $adminCommisionTotal + $adminCommision;
                $orderSubtotal = $orderSubtotal + $subTotal;
                $sgstItem = round($subTotal * round($results[0]['sgst'] * 0.01, 2), 2);
                $cgstItem = round($subTotal * round($results[0]['cgst'] * 0.01, 2), 2);
                $sgstTotal = $sgstTotal + $sgstItem;
                $cgstTotal = $cgstTotal + $cgstItem;

                $total = $subTotal + $sgstItem + $cgstItem;
                $orderTotal = round(($orderTotal + $subTotal + $sgstItem + $cgstItem), 2);
                $totalQuantity = $totalQuantity + $order['quantity'];

                 $queryInsertItem = "INSERT INTO
orderItem 
SET      userId=:userId,orderId=:orderId,productId=:productId,productSkuId=:productSkuId,
quantity=:quantity,discount=:discount,  price=:price,total=:total,subTotal=:subTotal,
 sgst=:sgst,cgst=:cgst,adminCommision=:adminCommision, createdBy=:createdBy,createdOn=:createdOn";


                $stmt1 = $pdo->prepare($queryInsertItem);
                $stmt1->bindParam(":userId", $userId);
                $stmt1->bindParam(":orderId", $orderId);
                $stmt1->bindParam(":productId", $order["pid"]);
                $stmt1->bindParam(":productSkuId", $order['pSkuid']);

                $stmt1->bindParam(":quantity", $order["quantity"]);
                $stmt1->bindParam(":discount", $results[0]['discount']);
                $stmt1->bindParam(":price", $results[0]['price']);
                $stmt1->bindParam(":total", $total);
                $stmt1->bindParam(":subTotal", $subTotal);
                $stmt1->bindParam(":adminCommision", $adminCommision, PDO::PARAM_STR);

                $stmt1->bindParam(":cgst", $cgstItem, PDO::PARAM_STR);
                $stmt1->bindParam(":sgst", $sgstItem, PDO::PARAM_STR);
                $stmt1->bindParam(":createdBy", $userId);
                $stmt1->bindParam(":createdOn", $createdOn);

                $stmt1->execute();
                // Commit the transaction
// $pdo->commit();
            }
        }

        $insertOrderDetails = "INSERT INTO
    orderdetails
SET      userId=:userId, orderId=:orderId,paymentId=:paymentId,sellerId=:sellerId,status=:status,totalQuantity=:totalQuantity,
         adminCommision=:adminCommision, deliveryAddress=:deliveryAddress,deliveryInstruction=:deliveryInstruction, 
             sgst=:sgst,cgst=:cgst,createdBy=	:createdBy, 
            createdOn=:createdOn,total=:total,subTotal=:subTotal";
        $stmt2 = $pdo->prepare($insertOrderDetails);
        $stmt2->bindParam(":userId", $userId);
        $stmt2->bindParam(":orderId", $orderId);
        $stmt2->bindParam(":paymentId", $paymentId);
        $stmt2->bindParam(":sellerId", $sellerId);

        $stmt2->bindParam(":adminCommision", $adminCommision);
        $stmt2->bindParam(":deliveryAddress", $deliveryAddress);

        $stmt2->bindParam(":deliveryInstruction", $deliveryInstruction);
        $stmt2->bindParam(":sgst", $sgstTotal);
        $stmt2->bindParam(":cgst", $cgstTotal);

        $stmt2->bindParam(":status", $orderStaus);
        $stmt2->bindParam(":totalQuantity", $totalQuantity);


        $stmt2->bindParam(":adminCommision", $adminCommisionTotal);

        $stmt2->bindParam(":total", $orderTotal);
        $stmt2->bindParam(":subTotal", $orderSubtotal);
        $stmt2->bindParam(":createdBy", $userId);



        $stmt2->bindParam(":createdOn", $createdOn);

        $stmt2->execute(); 
    }
    catch(exception $e){
//header('Location:../shop.php');
    }
}



if ($success === true) {

     $html = "Payment Successfull........";

    $orderId="";
    if($_SESSION['user_address_type'] == 'online'){
    $attributes = array(
        'razorpay_order_id' => $_SESSION['razorpay_order_id'],
        'razorpay_payment_id' => $_POST['razorpay_payment_id'],
        'razorpay_signature' => $_POST['razorpay_signature']
    );


    $paid="PAID";
    $orderId=$_POST['razorpay_payment_id'];
    $stmt3 = $pdo->prepare("update orderdetails set paymentResponse=:response where orderId=:orderId");
    $stmt3->bindParam(':response', $paid);
    $stmt3->bindParam(':orderId',  $orderId, PDO::PARAM_STR);
    $stmt3->execute();
}
else{
    $paid="PAID";
    $orderId=$_SESSION['user_order_id'];
    $stmt3 = $pdo->prepare("update orderdetails set paymentResponse=:response where orderId=:orderId");
    $stmt3->bindParam(':response', $paid);
    $stmt3->bindParam(':orderId', $orderId, PDO::PARAM_STR);
    $stmt3->execute();
}

    if (!empty($decoded->data->email)) {
        $headers = "From: info@onlinesabjimandi.com \r\n";
        $headers .= "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";

        $to = trim($decoded->data->email);
        $subject = "Your order is placed successfully!";

        $message = "Dear <b></b> ,<br/> Welcome, <br />
        Your order has been placed successfully!
        <br/><br/>Your order id is " . $orderId . "<br /><br /><br />Visit us <a href='onlinesabjimandi.com' target='_blank'>onlinesabjimandi.com</a> to get check status. <br /><br/>Thanks <br/> Team Onlne Sabji mandi";

        mail($to, $subject, $message, $headers);

           
    }
    // echo "$abc"yourform;
    setcookie('user_cart', '', time() - 3600, "/");
    echo '
    <form action="../receipt.php" id="yourform" method="POST">
        <input type="hidden" name="roi" value="' .  $_SESSION['razorpay_order_id']. '">
         <input type="hidden" name="rpi" value="' . $_POST['razorpay_payment_id'] . '">
          <input type="hidden" name="rs" value="' . $_POST['razorpay_signature'] . '">
    </form>
<script>            
document.addEventListener("DOMContentLoaded", function(event) {
        document.createElement(
            "form").submit.call(document.getElementById("yourform"));
        });         
</script>
';



} else {
    $txnId = $error;
    $html = include "response/failure.php";
    $paid="FAILED";
    $stmt3 = $pdo->prepare("update orderDetails set paymentResponse=:response where orderId=:orderId");
    $stmt3->bindParam(':response', $paid, PDO::PARAM_STR);
    $stmt3->bindParam(':orderId', $_SESSION['user_order_id'], PDO::PARAM_STR);
    $stmt3->execute();

    if (!empty($decoded->data->email)) {
        $headers = "From: kumar@glintel.com \r\n";
        $headers .= "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";

        $to = trim($decoded->data->email);
        $subject = "Your order is placed successfully!";

        $message = "Dear <b></b> ,<br/> Welcome, <br />
        Your order is failed, please check teh order and try again!
        <br/><br/>Your order id is " . $_POST['user_order_id'] . "<br /><br /><br />Visit us <a href='onlinesabjimandi.com' target='_blank'>onlinesabjimandi.com</a> to get check status. <br /><br/>Thanks <br/> Team Onlne Sabji mandi";

        mail($to, $subject, $message, $headers);

           
    }
    //Expire the cookies - dharm
   setcookie('user_cart', '', time() - 3600, "/");
    echo '
    <form action="../receipt.php" id="yourform" method="POST">
        <input type="hidden" name="roi" value="FAILED">
         <input type="hidden" name="rpi" value="FAILED">
          <input type="hidden" name="rs" value="FAILED">
    </form>
<script>            
document.addEventListener("DOMContentLoaded", function(event) {
        document.createElement(
            "form").submit.call(document.getElementById("yourform"));
        });         
</script>
';
}
echo $html;