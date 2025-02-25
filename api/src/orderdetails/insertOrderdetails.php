<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/database.php';
include_once '../../objects/orderdetail.php';
include_once '../../constant.php';
require '../../php-jwt/src/JWT.php';
require '../../php-jwt/src/ExpiredException.php';
require '../../php-jwt/src/SignatureInvalidException.php';
require '../../php-jwt/src/BeforeValidException.php';
use \Firebase\JWT\JWT;

// get database connection
  
$database = new Database();
$db = $database->getConnection();
  
$insert_order_detail = new Orderdetail($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));
//print_r($data);  
$getHeaders = apache_request_headers();
//print_r($getHeaders);
$jwt = "123";

if($jwt){

    try {

         //$decoded = JWT::decode($jwt, $SECRET_KEY, array('HS256'));
// make sure data is not empty
if(1
    // !empty($data->order_id) &&
    // !empty($data->productId) &&
    // !empty($data->quantity) 
)

{
     
     $insert_order_detail->orderId = $data->orderId;
     $insert_order_detail->userId= $data->userId;
     $insert_order_detail->sellerId= $data->sellerId;
     $insert_order_detail->deliveryId= $data->deliveryId;
     $insert_order_detail->paymentId= $data->paymentId;
     $insert_order_detail->sgst= $data->sgst;
     $insert_order_detail->cgst= $data->cgst;
     $insert_order_detail->total= $data->total;
     $insert_order_detail->adminCommision= $data->adminCommision;
     $insert_order_detail->createdOn= $data->createdOn;
     $insert_order_detail->createdBy= $data->createdBy;
    
       
    //var_dump($exam);
    // create the reg
    if($insert_order_detail->insertorderdetails()){

        http_response_code(201);
        echo json_encode(array("message"=>"Successfull"));
    }
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Unable to insert user"));
    }
}
  
}
catch (Exception $e){
    // print_r($e);
          http_response_code(401);
      
          echo json_encode(array(
              "message" => "Access denied.",
              "error" => $e->getMessage()
          ));
      }
      
  }
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "Unable to insert user. Data is incomplete."));
}
?>