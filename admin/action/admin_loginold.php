<?php
//
include '../constant.php';
include_once '../../api/objects/curl.php';
$password= $_POST["password"]; 
$username= $_POST["username"];
$url = $URL."admin/readAdmin.php";
$data = array( "password" =>$password, "username" =>$username);
print_r($data);
$postdata = json_encode($data);
$readCurl =new Curl();
$readCurl->createCurl($url,$postdata,0,10,true);
print_r($readCurl);

$result = (json_decode($response));

print_r($result);
//  print_r($result->token);
if(true){

 $_SESSION["JWT"]=$result->token;
 header('Location:../products.php');
} else
{
 header('Location:../account.php?msg='.$result->message);
}

function giplCurl($api,$postdata){
   $url = $api; 
    $client = curl_init($url);
    curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($client, CURLOPT_POSTFIELDS, $postdata);
    $response = curl_exec($client);
  //print_r($response);
    return $result = json_decode($response);
}

?>