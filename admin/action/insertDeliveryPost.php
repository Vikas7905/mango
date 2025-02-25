<?php
include '../../constant.php';
$name=trim(strtoupper($_POST["name"]));
$phoneNo=strtoupper($_POST["phoneNo"]);
$email=strtoupper($_POST["email"]);
$city=strtoupper($_POST["city"]);
$workingAddress=strtoupper($_POST["workingAddress"]);
$regidenceAddress=strtoupper($_POST["regidenceAddress"]);
$workingPincode=strtoupper($_POST["workingPincode"]);
$status=1;
$aadhar=strtoupper($_POST["aadhar"]);
$password=strtoupper($_POST["password"]);
$pan=strtoupper($_POST["pan"]);
$createdOn=date('Y-m-d h:i:sa');
$createdBy= "Admin";
$url = $URL . "deliveryBoy/insertDelivery.php";
$target_dir = "../img/delivery/";
$path="../img/delivery/".$pan; 
$data = array(
  "name" => $name,
  "phoneNo" => $phoneNo,
  "city" => $city,
  "email" => $email,
  "workingAddress" => $workingAddress,
  "regidenceAddress" => $regidenceAddress,
  "workingPincode" => $workingPincode,
  "status" => $status,
  "aadhar" => $aadhar,
  "password" => $password,
  "pan" => $pan,
  "image" => $target_dir,
  "createdOn"=>$createdOn,
  "createdBy"=>$createdBy);
$postdata = json_encode($data);
$result_registration=url_encode_Decode($url,$postdata);

//get max id from delivery Table

$urlmax = $URL . "deliveryBoy/readDeliveryMaxId.php";
$maxiddata = array();
$postdatamaxid = json_encode($maxiddata);
$clientmaxid = curl_init($urlmax);
curl_setopt($clientmaxid, CURLOPT_POSTFIELDS, $postdatamaxid);
curl_setopt($clientmaxid, CURLOPT_CONNECTTIMEOUT, 0); 
curl_setopt($clientmaxid, CURLOPT_TIMEOUT, 4); //timeout in seconds
curl_setopt($clientmaxid,CURLOPT_RETURNTRANSFER,true);
$responsemaxid = curl_exec($clientmaxid);
curl_close($clientmaxid);
$result_maxid = (json_decode($responsemaxid));
$maxid=$result_maxid->records[0]->id;

 // insert delivery id in delivery bank details

echo $urlmaxin = $URL . "deliveryBoy/insertDeliverybank.php";
$maxiddatain = array("id"=>$maxid,"createdOn"=>$createdOn,
  "createdBy"=>$createdBy);
  print_r($maxiddatain);
$postdatamaxidin = json_encode($maxiddatain);
$clientmaxidin = curl_init($urlmaxin);
curl_setopt($clientmaxidin, CURLOPT_POSTFIELDS, $postdatamaxidin);
curl_setopt($clientmaxidin, CURLOPT_CONNECTTIMEOUT, 0); 
curl_setopt($clientmaxidin, CURLOPT_TIMEOUT, 4); //timeout in seconds
curl_setopt($clientmaxidin,CURLOPT_RETURNTRANSFER,true);
$responsemaxidin = curl_exec($clientmaxidin);
curl_close($clientmaxid);
$resultmaxidin = (json_decode($responsemaxidin));
$maxid=$result_maxid->records[0]->id;



// insert delivery id in delivery income

$urlincome = $URL . "deliveryBoy/insertDeliveryIncome.php";
$dataincome = array("id"=>$maxid,"createdOn"=>$createdOn,
  "createdBy"=>$createdBy);
$postdataincome = json_encode($dataincome);
$clientincome = curl_init($urlincome);
curl_setopt($clientincome, CURLOPT_POSTFIELDS, $postdataincome);
curl_setopt($clientincome, CURLOPT_CONNECTTIMEOUT, 0); 
curl_setopt($clientincome, CURLOPT_TIMEOUT, 4); //timeout in seconds
curl_setopt($clientincome,CURLOPT_RETURNTRANSFER,true);
$responseincome = curl_exec($clientincome);
curl_close($clientincome);
$resulincome = (json_decode($responsemaxidin));
$maxid=$result_maxid->records[0]->id;



//Insert History Data

$urlhist = $URL . "deliveryBoy/insertDeliveryHistory.php";
$data = array(
  "name" => $name,
  "password" => $password,
  "city" => $city,
  "delivery_id" => $maxid,
  "phoneNo" => $phoneNo,
  "email" => $email,
  "workingAddress" => $workingAddress,
  "regidenceAddress" => $regidenceAddress,
  "workingPincode" => $workingPincode,
  "status" => $status,
  "aadhar" => $aadhar,
  "pan" => $pan,
  "image" => $target_dir,
  "createdOn"=>$createdOn,
  "createdBy"=>$createdBy);
$postdatamaxidin = json_encode($data);
$clientmaxidin = curl_init($urlhist);
curl_setopt($clientmaxidin, CURLOPT_POSTFIELDS, $postdatamaxidin);
curl_setopt($clientmaxidin, CURLOPT_CONNECTTIMEOUT, 0); 
curl_setopt($clientmaxidin, CURLOPT_TIMEOUT, 4); //timeout in seconds
curl_setopt($clientmaxidin,CURLOPT_RETURNTRANSFER,true);
$responsemaxidin = curl_exec($clientmaxidin);
curl_close($clientmaxid);
$resultmaxidin = (json_decode($responsemaxidin));


// Insert  Delivery Payment
$urlpayment = $URL . "deliveryBoy/insertDeliveryPyament.php";
$data = array(
  "workingPincode" => $workingPincode,
  "city" => $city,
  "createdOn"=>$createdOn,
  "createdBy"=>$createdBy);
$postdatamaxidin = json_encode($data);
$clientmaxidin = curl_init($urlpayment);
curl_setopt($clientmaxidin, CURLOPT_POSTFIELDS, $postdatamaxidin);
curl_setopt($clientmaxidin, CURLOPT_CONNECTTIMEOUT, 0); 
curl_setopt($clientmaxidin, CURLOPT_TIMEOUT, 4); //timeout in seconds
curl_setopt($clientmaxidin,CURLOPT_RETURNTRANSFER,true);
$responsemaxidin = curl_exec($clientmaxidin);
curl_close($clientmaxid);
$resultmaxidin = (json_decode($responsemaxidin));


if($result_registration->message=="Successfull"){

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
     $check = getimagesize($_FILES["photo"]["tmp_name"]);
    // $check_thumb = getimagesize($_FILES["fileUploadThumb"]["tmp_name"]);

      if(($check !== false) )
       {
        
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
    if ($_FILES["photo"]["size"] > 5000000) {
     
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

      if(move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {

        
        //echo "The file ". htmlspecialchars( basename( $_FILES["fileUpload"]["name"])). " has been uploaded.";
       // echo "The file ". htmlspecialchars( basename( $_FILES["fileUploadThumb"]["name"])). " has been uploaded.";
        $_SESSION["registration"] = "File uploaded succesfully.";
        header('Location:../manage-deliveryBoy.php');
      }
       else {
        //echo "Sorry, there was an error uploading your file.";
      
      $_SESSION["registration"] = "Sorry, there was an error uploading your file.";
      //header('Location:../insert-delivery.php');
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
print_r($response);
return $result = json_decode($response);

}

$urlmax = $URL . "deliveryBoy/readDeliveryMaxId.php";
$maxiddata = array();
$postdatamaxid = json_encode($maxiddata);
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