<?php
session_start();
include '../../constant.php';

/////////////////////
$orderId = "ORD_" . time() . rand(1000, 9999);
$result = json_decode($_COOKIE['user_cart'], true);
$sellerId = "";
$paymentId = "RZP_1123";
$userId = $_SESSION['email'];
$adminCommision = $COMMISION;
$total = 0;
$sgst = 0;
$cgst = 0;



foreach ($result as $index => $order) {
  print_r(value: $order);
  echo "****<br>";
  $skuId= $order["pSkuid"];
  $pid= $order["pid"];
  
  $url = $URL."product/readproductById.php";
  $dataProd = array("skuId"=>$skuId,"pid"=>$pid);
  $postdataProd = json_encode($dataProd);
 // print_r($dataProd);
  $client = curl_init($url);
  curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
  curl_setopt($client, CURLOPT_POSTFIELDS, $postdataProd);
  $responseProd = curl_exec($client);

  // print_r($responseProd);
   $resultProd = json_decode($responseProd);
   //print_r($resultProd);


  $total=$total+( $resultProd->records[0]->price*$order['quantity']);
  $url = $URL . "order/insertAllOrder.php";
  $dataInsOrd = array(
    "orderId" => $orderId,
    "productId" => $order['pid'],
    "productSkuId" => $order['pSkuid'],
    "quantity" => $order['quantity'],
    "discount" =>$resultProd->records[0]->discount,
    "price" => $resultProd->records[0]->price,
    "total" => $total,
    "sgst" => $total*$SGST*0.01,
    "cgst" => $total*$CGST*0.01
  );
  print_r($dataInsOrd);
  $postdataInsOrd = json_encode($dataInsOrd);
  $client = curl_init($url);
  curl_setopt($client, CURLOPT_POSTFIELDS, $postdataInsOrd);
  curl_setopt($client, CURLOPT_CONNECTTIMEOUT, 0);
  curl_setopt($client, CURLOPT_TIMEOUT, 4); //timeout in seconds
  curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
  $response = curl_exec($client);
  curl_close($client);
  // print_r(value: $response);

  $result = (json_decode($response)); 

}


$url_all = $URL . "order/insertOrder.php";
$dataOrd = array("userId" => $userId, "sellerId" => $sellerId, "orderId" => $orderId,"paymentId"=>$paymentId,"total"=>$total,
"adminCommision"=>$adminCommision,"createdBy"=>"Me");
//print_r($data); 
$postdataOrd = json_encode($dataOrd);
$client = curl_init($url_all);
curl_setopt($client, CURLOPT_POSTFIELDS, $postdataOrd);
curl_setopt($client, CURLOPT_CONNECTTIMEOUT, 0);
curl_setopt($client, CURLOPT_TIMEOUT, 4); //timeout in seconds
curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($client);
curl_close($client);
print_r($response);

$result = (json_decode($response));

//if ($result->message = "Update successfully") {


  //header('Location:../category.php');
//} else {
  //echo "Bad";
  //header('Location:../category.php?msg='.$result->message);
//}


//print_r($result);
//  print_r($result->token);

?>