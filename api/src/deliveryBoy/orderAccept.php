<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// get database connection
include_once '../../config/database.php';
include_once '../../objects/orderdetail.php';
include_once '../../constant.php';
require '../../php-jwt/src/JWT.php';
require '../../php-jwt/src/ExpiredException.php';
require '../../php-jwt/src/SignatureInvalidException.php';
require '../../php-jwt/src/BeforeValidException.php';
use \Firebase\JWT\JWT;

  
$database = new Database();
$db = $database->getConnection();
  
$update_order_details = new Orderdetail($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));
$update_order_details->orderId=$data->orderId;
$getHeaders = apache_request_headers();
//print_r($data);
// $jwt = $getHeaders['Authorization'];
$jwt = '123';

if($jwt){

    try {

        //  $decoded = JWT::decode($jwt, $SECRET_KEY, array('HS256'));
 //print_r($data);

// mavarke sure data is not empty
if(1
    // !empty($data->id) &&
    // !empty($data->password)
)

{
    $update_order_details->deliveryId=$data->deliveryId;
    $update_order_details->status=$data->status;
    $update_order_details->updatedOn=$data->updatedOn;
    $update_order_details->updatedBy=$data->updatedBy;

    if($update_order_details->updateorderdetailsforDelivery()){
  
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("message" => "Update successfully"));
    }
  
    // if unable to create the reg, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Unable to Approve user"));
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
    echo json_encode(array("message" => "Unable to Approve user. Data is incomplete."));
}
?>