<?php
session_unset();
session_start();
include '../../constant.php';
$username= $_POST["username"]; 
$pwd= $_POST["password"];
$url = $URL."admin/adminLogin.php";
$data = array( "username" =>$username, "password" =>$pwd);
//print_r($data);
$postdata = json_encode($data);
$client = curl_init($url);
curl_setopt($client, CURLOPT_POSTFIELDS, $postdata);
curl_setopt($client, CURLOPT_CONNECTTIMEOUT, 0); 
curl_setopt($client, CURLOPT_TIMEOUT, 4); //timeout in seconds
curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
$response = curl_exec($client);
//$response->message;
curl_close($client);
// print_r($response);
$result = (json_decode($response));
// print_r($result);
$_SESSION["message"]=$result->message;
if($result->message=="Successfull"){
 $_SESSION["JWT"]="123";
 $_SESSION["id"]="1";
 $_SESSION["alogin"]=$username;
 $_SESSION["password"]=$pwd;
 header('Location:../change-password.php');
} else
{
header('Location:../index.php?msg='.$result->message);
}
?>