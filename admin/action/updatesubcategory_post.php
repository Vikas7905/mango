<?php
include '../../constant.php';
$name= $_POST["name"];
$parentId= $_POST["parentId"];
$id= $_POST["id"];
$updatedOn=date('Y-m-d h:i:sa');
$createdBy="Admin";
$image=$id;
$url = $URL."subcategory/updatesubcategory.php";
$data = array( "name" =>$name,"id" =>$id,"updatedOn"=>$updatedOn);
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
if($result->message="Update successfully"){

  /* --- get maximum userid -----*/

  $maxid=$id;
  $maxId_postdata = json_encode($maxid);
  $target_dir = "../img/subcategory"."/".$maxid;
  //$maxid;
 $path="../img/subcategory"."/".$maxid;
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
    //$_SESSION["registration"] = "File uploaded succesfully.";
    $urlsubhistory = $URL."subcategory/insertsubcategoryHistory.php";
    $data = array( "name" =>$name,"parentId" =>$parentId,"createdOn"=>$updatedOn, "createdBy"=>$createdBy,"subcategoriesImag"=>$image);
    print_r($data);
    $postdata = json_encode($data);
    $client = curl_init($urlsubhistory);
    curl_setopt($client, CURLOPT_POSTFIELDS, $postdata);
    curl_setopt($client, CURLOPT_CONNECTTIMEOUT, 0); 
    curl_setopt($client, CURLOPT_TIMEOUT, 4); //timeout in seconds
    curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
    $response = curl_exec($client);
    curl_close($client);
    //print_r($response);
    
    $resultsub = (json_decode($response));

   header('Location:../subcategory.php');
  }
   else {
    //echo "Sorry, there was an error uploading your file.";
  
  //$_SESSION["registration"] = "Sorry, there was an error uploading your file.";
  header('Location:../subcategory.php');
}
}   
}
else{
  header('Location:../subcategory.php?msg='.$result->message);
}


//print_r($result);
//  print_r($result->token);

?>
