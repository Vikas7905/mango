<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/database.php';
include_once '../../objects/cart.php';
// get database connection
  
$database = new Database();
$db = $database->getConnection();
  
$insert_cart = new Cart($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));
//print_r($data);  
// make sure data is not empty
if(
    1
    // !empty($data->userType) &&
    // !empty($data->userName) &&
    // !empty($data->userMobile) &&
    // !empty($data->userEmail) &&
    // !empty($data->userPass)
)

{
    $insert_cart->userId = $data->userId;
    $insert_cart->productId = $data->productId;
    $insert_cart->quantity = $data->quantity;
    $insert_cart->postingDate = $data->postingDate;
        
    //var_dump($exam);
    // create the reg
    if($insert_cart->insertCart()){

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
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "Unable to insert user. Data is incomplete."));
}
?>