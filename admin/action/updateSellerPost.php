<?php
include '../../constant.php';
$id=$_POST["id"];
$sellerName=trim(strtoupper($_POST["sellerName"]));
$phoneNo=strtoupper($_POST["phoneNo"]);
$email=strtoupper($_POST["email"]);
$gst=strtoupper($_POST["gst"]);
$regFee=strtoupper($_POST["regFee"]);
$counterName=strtoupper($_POST["counterName"]);
$aadhar=strtoupper($_POST["aadhar"]);
$pan=strtoupper($_POST["pan"]);
$updatedOn=date('Y-d-m h:i:sa');
$updatedBy= "Admin";
$url = $URL . "seller/update_seller.php";

$data = array(

  "sellerName" => $sellerName,
  "id" => $id,
  "counterName" => $counterName,
  "phoneNo" => $phoneNo,
  "gst" => $gst,
  "email" => $email,
  "regFee" => $regFee,
  "aadhar" => $aadhar,
  "pan" => $pan,
  "updatedOn"=>$updatedOn,
  "updatedBy"=>$updatedBy);
   $postdata = json_encode($data);
  print_r($data);
  $client = curl_init($url);
  curl_setopt($client, CURLOPT_POSTFIELDS, $postdata);
  curl_setopt($client, CURLOPT_CONNECTTIMEOUT, 0); 
  curl_setopt($client, CURLOPT_TIMEOUT, 4); //timeout in seconds
  curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
  $response = curl_exec($client);
  curl_close($client);
  //print_r($response);
  $result_registration = (json_decode($response));
 //print_r($result_registration);


  if($result_registration->message=="Successfull"){

  /* --- get maximum userid -----*/

   // $data_maxId=$pan;
    $maxId_postdata = json_encode($pan);
    //$result_max_registration=url_encode_Decode($url_read_maxId,$maxId_postdata);
    //$id=$result_max_registration->records[0]->id;


/*--- update the images in img folder inside user folder ---*/

    $target_dir = "../img/seller/";
    $path="../img/seller/".$pan;
    if (!is_dir($path)){
    mkdir($path, 0777, true);
    //echo "directory created";
    }
    else{ 
     // echo "unable to create directory";
    }
   $target_file = $target_dir .$pan."/". $pan.".png";
   $target_file_thumb = $target_dir .$pan."/". $pan."_counter".".png";

    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $imageFileTypeThumb = strtolower(pathinfo($target_file_thumb,PATHINFO_EXTENSION));
    
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
     $check = getimagesize($_FILES["upload"]["tmp_name"]);
     $check_thumb = getimagesize($_FILES["shopupload"]["tmp_name"]);

      if(($check !== false) &&($check_thumb !== false)) {
        
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
    if ($_FILES["upload"]["size"] > 5000000) {
     
      $uploadOk = 0;
    }
    {
      
      $uploadOk = 1;
    }
    
    // Allow certain file formats
    if(($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif")  && ($imageFileTypeThumb != "jpg" && $imageFileTypeThumb != "png" && $imageFileTypeThumb != "jpeg"
    && $imageFileTypeThumb != "gif")){
    
      $uploadOk = 0;
    }
    
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
    
    } else {

      if ((move_uploaded_file($_FILES["upload"]["tmp_name"], $target_file)) 
      && (move_uploaded_file($_FILES["shopupload"]["tmp_name"], $target_file_thumb))) {
        //echo "The file ". htmlspecialchars( basename( $_FILES["fileUpload"]["name"])). " has been uploaded.";
       // echo "The file ". htmlspecialchars( basename( $_FILES["fileUploadThumb"]["name"])). " has been uploaded.";
        $_SESSION["registration"] = "File uploaded succesfully.";
       header('Location:../manage-seller.php');
      }
       else {
        //echo "Sorry, there was an error uploading your file.";
      
      $_SESSION["registration"] = "Sorry, there was an error uploading your file.";
      header('Location:../insert-seller.php');
    }
  }   
   
}
else{
   header('Location:../manage-seller.php?msg=Failed');
}
function url_encode_Decode($url,$postdata){
    $client = curl_init($url);
curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
curl_setopt($client, CURLOPT_POSTFIELDS, $postdata);
$response = curl_exec($client);
//print_r($response);
return $result = json_decode($response);

}
?>