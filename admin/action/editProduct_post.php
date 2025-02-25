<?php
include '../../constant.php';
$pid=strtoupper($_POST["pid"]);
$skuId=strtoupper($_POST["skuId"]);
$productName=strtoupper($_POST["productName"]);
$description=strtoupper($_POST["productDescription"]);
$status=strtoupper($_POST["status"]);;
$price=strtoupper($_POST["price"]);
$quantity=strtoupper($_POST["quantity"]);
$discount=strtoupper($_POST["discount"]);
$updatedOn= date('Y-m-d h:i:sa');
$updatedBy=strtoupper($_POST["sellerId"]);
$url = $URL . "product/updateproduct.php";

//$url = $URL . "deliveryBoy/insertDelivery.php";
//$url_read_maxId=$URL . "registration/read_maxId.php";
   $data = array(
   "pid" => $pid,
  "image" => $skuId,
  "mainImage" => $skuId,
  "name" => $productName,
  "description" => $description,
  "status" => $status,
  "price" => $price,
  "discount" => $discount,
  "updatedOn"=> $updatedOn,
  "updatedBy"=> $updatedBy);

  $postdata = json_encode($data);
//  print_r($data);
  $client = curl_init($url);
  curl_setopt($client, CURLOPT_POSTFIELDS, $postdata);
  curl_setopt($client, CURLOPT_CONNECTTIMEOUT, 0); 
  curl_setopt($client, CURLOPT_TIMEOUT, 4); //timeout in seconds
  curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
  $response = curl_exec($client);
  curl_close($client);
//  print_r($response);
  $result= (json_decode($response));
//print_r($result);

 // get Max Product Id   
// no need to read max id
 
//<!Product history insert data ->
$urlhistory = $URL . "producthistory/insertproducthistory.php"; 
$datahistory = array(
  "productId" => $pid,
  "skuId" => $skuId,
  "discount" => $discount,
  "price" => $price,
  "quantity" => $quantity,
  "createdOn"=>$updatedOn,
  "createdBy"=>$updatedBy);
  $postdatahistory = json_encode($datahistory);
  //print_r($postdatahistory);
  $clienthistory = curl_init($urlhistory);
  curl_setopt($clienthistory, CURLOPT_POSTFIELDS, $postdatahistory);
  curl_setopt($clienthistory, CURLOPT_CONNECTTIMEOUT, 0); 
  curl_setopt($clienthistory, CURLOPT_TIMEOUT, 4); //timeout in seconds
  curl_setopt($clienthistory,CURLOPT_RETURNTRANSFER,true);
  $responsemax = curl_exec($clienthistory);
  curl_close($clienthistory);
// print_r($responsemax);
  $resulthistory= (json_decode($responsemax));



  // insert product sku id
  $urlhistory = $URL . "productskuid/updateproduct.php"; 
  $datahistory = array(
    "pid" => $pid,
    "price" => $price,
    "quantity" => $quantity,
    "updatedOn"=>$updatedOn,
    "updatedBy"=>$updatedBy);
    $postdatahistory = json_encode($datahistory);
    //print_r($postdatahistory);
    $clienthistory = curl_init($urlhistory);
    curl_setopt($clienthistory, CURLOPT_POSTFIELDS, $postdatahistory);
    curl_setopt($clienthistory, CURLOPT_CONNECTTIMEOUT, 0); 
    curl_setopt($clienthistory, CURLOPT_TIMEOUT, 4); //timeout in seconds
    curl_setopt($clienthistory,CURLOPT_RETURNTRANSFER,true);
    $responsemax = curl_exec($clienthistory);
    curl_close($clienthistory);
  //  print_r($responsemax);
    $resulthistory= (json_decode($responsemax));



//print_r($result);

  if($result->message=="Successfull"){

  /* --- get maximum userid -----*/

    $data_maxId=$skuId;
    $maxId_postdata = json_encode($data_maxId);
    // $result_max_registration=url_encode_Decode($url_read_maxId,$maxId_postdata);
    // $id=$result_max_registration->records[0]->id;


/*--- update the images in img folder inside user folder ---*/

    $target_dir = "../productimages";
    $path="../productimages/".$skuId;
    if (!is_dir($path)){
    mkdir($path, 0777, true);
    //echo "directory created";
    }
    else{ 
     // echo "unable to create directory";
    }
   $target_file = $target_dir ."/".$skuId."/". $skuId."1.png";
   //$target_file_thumb = $target_dir .$id."/profile/". $id."_thumb".".png";

    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    //$imageFileTypeThumb = strtolower(pathinfo($target_file_thumb,PATHINFO_EXTENSION));
    
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {

      $productimage1 = getimagesize($_FILES["productimage1"]["tmp_name"]);
    //   $productimage2 = getimagesize($_FILES["productimage2"]["tmp_name"]);
    //   $productimage3 = getimagesize($_FILES["productimage3"]["tmp_name"]);
    //   $productimage4 = getimagesize($_FILES["productimage4"]["tmp_name"]);
    // // $check_thumb = getimagesize($_FILES["fileUploadThumb"]["tmp_name"]);

      if($productimage1 !== false) {
        
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
    if ($_FILES["productimage1"]["size"] > 5000000) {
     
      $uploadOk = 0;
    }
    {
      
      $uploadOk = 1;
    }
    
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"){
    
      $uploadOk = 0;
    }
    
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
    
    } else {

      if(move_uploaded_file($_FILES["productimage1"]["tmp_name"], $target_file)) {
        //echo "The file ". htmlspecialchars( basename( $_FILES["fileUpload"]["name"])). " has been uploaded.";
       // echo "The file ". htmlspecialchars( basename( $_FILES["fileUploadThumb"]["name"])). " has been uploaded.";
        $_SESSION["registration"] = "File uploaded succesfully.";
       header('Location:../manage-products.php');
      }
       else {
        //echo "Sorry, there wags an error uploading your file.";
      
      $_SESSION["registration"] = "Sorry, there was an error uploading your file.";
        header('Location:../manage-products.php');
    }
  }   
   
}
else{
    header('Location:../manage-products.php?msg=Failed');
}
?>