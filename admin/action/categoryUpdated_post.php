<?php
include '../../constant.php';
$name= $_POST["name"]; 
$commision= $_POST["commision"];
$id= $_POST["id"];
$sgst= $_POST["sgst"];
$cgst= $_POST["cgst"];
$description= $_POST["description"];
$updatedOn=date('Y-m-d h:i:sa');
$url = $URL."category/updateCategory.php";
$data = array( "name" =>$name,"sgst" =>$sgst,"cgst" =>$cgst, "commision" =>$commision,"updatedOn"=>$updatedOn, "description"=>$description,"id"=>$id);
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
$_SESSION['message']=$result->message;
if($result->message=="Update successfully"){
  //echo "hello";
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
    header('Location:../category.php?msg='.$result->message);
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

//print_r($result);
  ///Insert Category History Datatable
$insertcategoryHistor = $URL."category/insertCategoryHistory.php";
$data = array( "name" =>$name,"commision" =>$commision,"createdOn"=>$updatedOn, "createdBy"=>$id,"description"=>$description, "categoriesImage"=>$id, "c_id"=>$id);
//print_r($data);
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
if($result->message=="History Created"){


    header('Location:../category.php');
    }
  }
     else {
      //echo "Sorry, there was an error uploading your file.";
    
    //$_SESSION["registration"] = "Sorry, there was an error uploading your file.";
    header('Location:../category.php');
  }
  }   
  
  }
  else{
     header('Location:../category.php?msg='.$result->message);
  }




//print_r($result);
//  print_r($result->token);

?>
