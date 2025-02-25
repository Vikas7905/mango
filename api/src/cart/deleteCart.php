<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// include database and object file
include_once '../../config/database.php';
include_once '../../objects/cart.php';
include_once '../../constant.php';


  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare admin object
$delete_cart = new Cart($db);
  
// get admin id
$data = json_decode(file_get_contents("php://input"));
$delete_cart->productId = $data->productId;
$delete_cart->productId = $data->productId;
//print_r($data);  
$getHeaders = apache_request_headers();
//print_r($getHeaders);
$jwt = "123";

if($jwt){

    try {

        // $decoded = JWT::decode($jwt, $SECRET_KEY, array('HS256'));
// set admin id to be deleted
  
// delete the admin
if($delete_cart->deleteCart()){
  
    // set response code - 200 ok
    http_response_code(200);
  
    // tell the user
    echo json_encode(array("message" => "Cart has been deleted."));
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
// if unable to delete the admin
else{
  
    // set response code - 503 service unavailable
    http_response_code(503);
  
    // tell the user
    echo json_encode(array("message" => "Unable to delete Record."));
}
?>