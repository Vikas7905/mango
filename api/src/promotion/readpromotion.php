<?php
// required headers
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
//database connection will be here

// include database and object files
include_once '../../config/database.php';
include_once '../../objects/promotion.php';
include_once '../../constant.php';



  
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$read_promotion = new Promotion($db);
  
$data = json_decode(file_get_contents("php://input"));
$read_promotion->id = $data->id;
// $read_promotion->productType=($data->productType);


if(true){

    try {


$stmt = $read_promotion->readpromotion();
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){
  
    // products array
    $read_promotion_arr=array();
    $read_promotion_arr["records"]=array();


    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
     
        extract($row);
       // print_r($row);
  
        $read_promotion_item=array(

            
           // "skuId"=>$skuId,
           "id"=>$id,
           "tHeading"=>$tHeading,
           "heading"=>$heading,
           "status"=>$status,
           "img"=>$img,
           "para"=>$para,
           "link"=>$link,
           "createdOn"=>$createdOn,
           "createdBy"=>$createdBy,
           "updatedOn"=>$updatedOn,
           "updatedBy"=>$updatedBy
        );
  
        array_push($read_promotion_arr["records"], $read_promotion_item);
    }

    // show products data in json format
    echo json_encode($read_promotion_arr);

     // set response code - 200 OK
     http_response_code(200);
}
}
catch (Exception $e){
          http_response_code(402);
      
          echo json_encode(array(
              "message" => "Access denied.",
              "error" => $e->getMessage()
          ));
      }
      
  }  
// no products found will be here
?>