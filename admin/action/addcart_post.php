<?php
session_start();
include '../../constant.php';
include_once '../../api/objects/curl.php';

$userId= $_SESSION['email'];
$price= $_POST["price"];
$productSkuid= $_POST["productSKUID"];
$productId= $_POST["productId"];
$sellerId=$_POST["sellerId"];
$quantity=$_POST["quantity"];
$createdOn=date('Y-m-d h:i:sa');

$url = $URL."cart/insertCart.php";
$data = array("price"=>$price, "userId"=>$userId,"productSkuid"=> $_POST["productSKUID"],
"sellerId"=>$_POST["sellerId"], "productId"=>$productId,"quantity"=>$quantity, "createdBy"=>$userId,
 "createdOn"=>$createdOn,"total"=>$price*$quantity);
print_r($data);

$postdata = json_encode($data);

$readCurl = new Curl();
 $response = $readCurl->createCurl($url, $postdata, 0, 5, 1);
 $result = (json_decode($response));


// //Product table quantity update



//  $productId= $_POST["productId"];
//  $quantity=$_POST["quantity"];
//  $updatedBy=$_POST["productId"];
//  $updatedOn=date('Y-m-d h:i:sa');
// $urlProductUpdate = $URL."product/updateProductQuantity.php";
// $dataProductUpdate = array("productId"=>$productId, "quantity"=>$quantity, "updatedBy"=>$updatedBy, "updatedOn"=>$updatedOn);
// //print_r($dataProductUpdate);
// $postdataProductUpdate = json_encode($dataProductUpdate);
// $clientProductUpdate = curl_init($urlProductUpdate);
// curl_setopt($clientProductUpdate, CURLOPT_POSTFIELDS, $postdataProductUpdate);
// curl_setopt($clientProductUpdate, CURLOPT_CONNECTTIMEOUT, 0); 
// curl_setopt($clientProductUpdate, CURLOPT_TIMEOUT, 4); //timeout in seconds
// curl_setopt($clientProductUpdate,CURLOPT_RETURNTRANSFER,true);
// $responseProductUpdate = curl_exec($clientProductUpdate);
// curl_close($clientProductUpdate);
// //print_r($response);
// $resultProductUpdate = (json_decode($responseProductUpdate));



//print_r($result);
 if($result->message="Successfull"){
  header('Location:../../shop.php?id='.rand(100,999).base64_encode(trim(string: $sellerId)));
 } else
 {
  header('Location:../../shop.php?msg='.$result->message);
 }
?>
