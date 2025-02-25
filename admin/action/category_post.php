<?php
include '../../constant.php';

function giplCurl($api,$postdata){
  $url = $api; 
   $client = curl_init($url);
   curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
   curl_setopt($client, CURLOPT_POSTFIELDS, $postdata);
   $response = curl_exec($client);
 // print_r($response);
   return $result = json_decode($response);
}

// Select Max Id//
$urlmaxid = $URL."category/readMaxId.php";
$datamaxId = array();
// //print_r($data);
$postdatamaxId = json_encode($datamaxId);
$clientmaxId = curl_init();
curl_setopt( $clientmaxId, CURLOPT_URL,$urlmaxid);
//curl_setopt( $client, CURLOPT_HTTPHEADER,  $request_headers);
curl_setopt($clientmaxId, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($clientmaxId, CURLOPT_POST, 5);
curl_setopt($clientmaxId, CURLOPT_POSTFIELDS, $postdatamaxId);
$responsemaxId = curl_exec($clientmaxId);
//print_r($responsemaxId);
$resultmaxId = json_decode($responsemaxId);
//print_r($resultmaxId);
$id=$resultmaxId->records[0]->id;
$id=$id+1;
/////////////////////
$name= $_POST["name"];
$cgst= $_POST["cgst"];
$sgst= $_POST["sgst"]; 
$commision= $_POST["commision"];
$description= $_POST["description"];
$status= 1;
$createdOn=date('Y-m-d h:i:sa');
$createdBy="Admin";
$url = $URL."category/insertCategory.php";
$data = array( "name" =>$name, "commision" =>$commision, "description" =>$description, "categoriesImage"=>$id,"createdOn"=>$createdOn,"sgst"=>$sgst,"cgst"=>$cgst,
"createdBy"=>$createdBy,"status"=>$status );
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
//echo $result->message="Successfull";
 //print_r($result);
//  print_r($result->token);

if($result->message=="Successfull"){
    
  
  header('Location:../category.php');
 } else
 {
  //echo "Bad";
  header('Location:../category.php?msg='.$result->message);
 }


/*--- update the images in img folder inside user folder ---*/
if($responsemaxId="True"){

  /* --- get maximum userid -----*/

    $data_maxId=$id;
    $maxId_postdata = json_encode($data_maxId);
$target_dir = "../img/category"."/".$id;
$path="../img/category"."/".$id;
if (!is_dir($path)){
mkdir($path, 0777, true);
//echo "directory created";
}
else{ 
 // echo "unable to create directory";
}
$target_file = $target_dir ."/". $id.".png";
//$target_file_thumb = $target_dir .$id."/profile/". $id."_thumb".".png";

$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
//$imageFileTypeThumb = strtolower(pathinfo($target_file_thumb,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
 $check = getimagesize($_FILES["image"]["tmp_name"]);
// $check_thumb = getimagesize($_FILES["fileUploadThumb"]["tmp_name"]);

  if($check !== false) {
    
    $uploadOk = 1;
  }
   else {
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  $uploadOk = 0;
}

// Check file size
if ($_FILES["image"]["size"] > 5000000) {
 
  $uploadOk = 0;
}
{
  
  $uploadOk = 1;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif"){

  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";

} else {

  if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
    //echo "The file ". htmlspecialchars( basename( $_FILES["fileUpload"]["name"])). " has been uploaded.";
   // echo "The file ". htmlspecialchars( basename( $_FILES["fileUploadThumb"]["name"])). " has been uploaded.";
    $_SESSION["registration"] = "File uploaded succesfully.";
   //header('Location:../manage-deliveryBoy.php');
  }
   else {
    //echo "Sorry, there was an error uploading your file.";
  
  $_SESSION["registration"] = "Sorry, there was an error uploading your file.";
   // header('Location:../insert-delivery.php');
}
}   

}
else{
//header('Location:../registration.php?msg=Failed');
}
?>
