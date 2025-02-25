<?php
session_start();
include '../../constant.php';
$name= $_POST["name"]; 
$commision= $_POST["commision"];
$id= $_POST["id"];
$sgst= $_POST["sgst"];
$cgst= $_POST["cgst"];
$description= $_POST["description"];
$updatedOn=date('Y-m-d h:i:sa');
$url = $URL."category/deleteCategory.php";
$data = array("id"=>$id);
//print_r($data);
$postdata = json_encode($data);
$client = curl_init($url);
curl_setopt($client, CURLOPT_POSTFIELDS, $postdata);
curl_setopt($client, CURLOPT_CONNECTTIMEOUT, 0); 
curl_setopt($client, CURLOPT_TIMEOUT, 4); //timeout in seconds
curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
$response = curl_exec($client);
curl_close($client);
//print_r($response);

$result = (json_decode($response));
//print_r($result);
$_SESSION['message']=$result->message;
if($result->message=="Deleted"){
  
  $insertcategoryHistor = $URL."category/insertCategoryHistory.php";
  $data = array("createdOn"=>$updatedOn, "createdBy"=>"Deleted","description"=>"$description", "categoriesImage"=>"","c_id"=>$id,"name"=>"$name","commision"=>"$commision");
  // print_r($data);
  $postdata = json_encode($data);
  $client = curl_init($insertcategoryHistor);
  curl_setopt($client, CURLOPT_POSTFIELDS, $postdata);
  curl_setopt($client, CURLOPT_CONNECTTIMEOUT, 0); 
  curl_setopt($client, CURLOPT_TIMEOUT, 4); //timeout in seconds
  curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
  $response = curl_exec($client);
  curl_close($client);
  //print_r($response);
  $result = (json_decode($response));
  //print_r($result);
  
 header('Location:../category.php');
 } else
 {
  //echo "Bad";
  header('Location:../category.php?msg='.$result->message);
 }


//print_r($result);
//  print_r($result->token);

?>
