<?php
session_start();
include '../../constant.php';
//$_SESSION['decoded'];
$decoded= isset($_SESSION['decoded'])?$_SESSION['decoded']:"";
//print_r($decoded);
$password= $_POST["password"];
//echo $decoded->data->email;
$url = $URL."user/update_user_password.php";
$data = array("password"=>$password, "email"=>$decoded->data->email);
// print_r($data);
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

if($result->message=="Update successfully"){
    
  
  header('Location:../../changePassword.php?msg='.$result->message);
  $_SESSION['alert_msg']="Password Updated Succefully";
 } else
 {
  //echo "Bad";
  header('Location:../../changePassword.php?msg='.$result->message);
 }
?>
