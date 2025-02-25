<?php
include '../../constant.php';
$id=$_POST['id'];
$name=trim(strtoupper($_POST["name"]));
$phoneNo=strtoupper($_POST["phoneNo"]);
$email=strtoupper($_POST["email"]);
$city=strtoupper($_POST["city"]);
$workingAddress=strtoupper($_POST["workingAddress"]);
$regidenceAddress=strtoupper($_POST["regidenceAddress"]);
$workingPincode=strtoupper($_POST["workingPincode"]);
$status=1;
$aadhar=strtoupper($_POST["aadhar"]);
$pan=strtoupper($_POST["pan"]);
$updatedOn=date('Y-m-d h:i:sa');
$updatedBy= "Admin";
$url = $URL . "deliveryBoy/updateDelivery.php";
$target_dir = "../img/delivery/";
$path="../img/delivery/".$pan; 

$data = array(
  "id" => $id,
  "name" => $name,
  "phoneNo" => $phoneNo,
  "email" => $email,
  "city" => $city,
  "workingAddress" => $workingAddress,
  "regidenceAddress" => $regidenceAddress,
  "workingPincode" => $workingPincode,
  "status" => $status,
  "aadhar" => $aadhar,
  "pan" => $pan,
  "image" => $target_dir,
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
  print_r($response);
$result_registration=url_encode_Decode($url,$postdata);
print_r($result_registration);



//get max id from delivery Table

// $urlmax = $URL . "deliveryBoy/readDeliveryMaxId.php";
// $maxiddata = array();
// $postdatamaxid = json_encode($maxiddata);
// //print_r($postdata);
// $clientmaxid = curl_init($urlmax);
// curl_setopt($clientmaxid, CURLOPT_POSTFIELDS, $postdatamaxid);
// curl_setopt($clientmaxid, CURLOPT_CONNECTTIMEOUT, 0); 
// curl_setopt($clientmaxid, CURLOPT_TIMEOUT, 4); //timeout in seconds
// curl_setopt($clientmaxid,CURLOPT_RETURNTRANSFER,true);
// $responsemaxid = curl_exec($clientmaxid);
// curl_close($clientmaxid);
// $result_maxid = (json_decode($responsemaxid));
// $maxid=$result_maxid->records[0]->id;

 // insert delivery id in delivery bank details

// $urlmaxin = $URL . "deliveryBoy/insertDeliverybank.php";
// $maxiddatain = array("id"=>$maxid,"createdOn"=>$createdOn,
//   "createdBy"=>$createdBy);
// $postdatamaxidin = json_encode($maxiddatain);
// //print_r($postdatamaxidin);
// $clientmaxidin = curl_init($urlmaxin);
// curl_setopt($clientmaxidin, CURLOPT_POSTFIELDS, $postdatamaxidin);
// curl_setopt($clientmaxidin, CURLOPT_CONNECTTIMEOUT, 0); 
// curl_setopt($clientmaxidin, CURLOPT_TIMEOUT, 4); //timeout in seconds
// curl_setopt($clientmaxidin,CURLOPT_RETURNTRANSFER,true);
// $responsemaxidin = curl_exec($clientmaxidin);
// //print_r($responsemaxidin);
// curl_close($clientmaxid);
// $resultmaxidin = (json_decode($responsemaxidin));
//echo $maxid=$result_maxid->records[0]->id;




// insert delivery id in delivery income

// $urlincome = $URL . "deliveryBoy/insertDeliveryIncome.php";
// $dataincome = array("id"=>$maxid,"createdOn"=>$createdOn,
//   "createdBy"=>$createdBy);
// $postdataincome = json_encode($dataincome);
// print_r($postdataincome);
// $clientincome = curl_init($urlincome);
// curl_setopt($clientincome, CURLOPT_POSTFIELDS, $postdataincome);
// curl_setopt($clientincome, CURLOPT_CONNECTTIMEOUT, 0); 
// curl_setopt($clientincome, CURLOPT_TIMEOUT, 4); //timeout in seconds
// curl_setopt($clientincome,CURLOPT_RETURNTRANSFER,true);
// $responseincome = curl_exec($clientincome);
// print_r($responsemaxidin);
// curl_close($clientincome);
// $resulincome = (json_decode($responsemaxidin));
//echo $maxid=$result_maxid->records[0]->id;

if($result_registration->message=="Update successfully"){

  /* --- get maximum userid -----*/

    $data_maxId=$pan;
    $maxId_postdata = json_encode($data_maxId);
    // $result_max_registration=url_encode_Decode($url_read_maxId,$maxId_postdata);
    // $id=$result_max_registration->records[0]->id;


/*--- update the images in img folder inside user folder ---*/

   
    if (!is_dir($path)){
    mkdir($path, 0777, true);
    //echo "directory created";
    }
    else{ 
     // echo "unable to create directory";
    }
   $target_file = $target_dir .$pan."/". $pan.".png";
   //$target_file_thumb = $target_dir .$id."/profile/". $id."_thumb".".png";

    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    //$imageFileTypeThumb = strtolower(pathinfo($target_file_thumb,PATHINFO_EXTENSION));
    
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
     $check = getimagesize($_FILES["profile"]["tmp_name"]);
    // $check_thumb = getimagesize($_FILES["fileUploadThumb"]["tmp_name"]);

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
    if ($_FILES["profile"]["size"] > 5000000) {
     
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

      if(move_uploaded_file($_FILES["profile"]["tmp_name"], $target_file)) {

        
        //echo "The file ". htmlspecialchars( basename( $_FILES["fileUpload"]["name"])). " has been uploaded.";
       // echo "The file ". htmlspecialchars( basename( $_FILES["fileUploadThumb"]["name"])). " has been uploaded.";
        $_SESSION["registration"] = "File uploaded succesfully.";
       header('Location:../manage-deliveryBoy.php');
      }
       else {
        //echo "Sorry, there was an error uploading your file.";
      
      $_SESSION["registration"] = "Sorry, there was an error uploading your file.";
      header('Location:../insert-delivery.php');
    }
  }   
   
}
else{
   //header('Location:../registration.php?msg=Failed');
}
function url_encode_Decode($url,$postdata){
$client = curl_init($url);
curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
curl_setopt($client, CURLOPT_POSTFIELDS, $postdata);
$response = curl_exec($client);
//print_r($response);
return $result = json_decode($response);

}

$urlmax = $URL . "deliveryBoy/readDeliveryMaxId.php";
$maxiddata = array();
$postdatamaxid = json_encode($maxiddata);
//print_r($postdata);
$clientmaxid = curl_init($urlmax);
curl_setopt($clientmaxid, CURLOPT_POSTFIELDS, $postdatamaxid);
curl_setopt($clientmaxid, CURLOPT_CONNECTTIMEOUT, 0); 
curl_setopt($clientmaxid, CURLOPT_TIMEOUT, 4); //timeout in seconds
curl_setopt($clientmaxid,CURLOPT_RETURNTRANSFER,true);
$responsemaxid = curl_exec($clientmaxid);
curl_close($clientmaxid);
$result_maxid = (json_decode($responsemaxid));
$maxid=$result_maxid->records[0]->id;

?>