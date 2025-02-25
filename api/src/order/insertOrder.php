<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/database.php';
include_once '../../objects/order.php';
include_once '../../constant.php';



// get database connection
  
$database = new Database();
$db = $database->getConnection();
  
$insert_order = new Order($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));
//print_r($data);  
$getHeaders = apache_request_headers();
//print_r($getHeaders);
//$jwt = $getHeaders['Authorization'];

if(true){

    try {

        // $decoded = JWT::decode($jwt, $SECRET_KEY, array('HS256'));
// make sure data is not empty
if(1
    // !empty($data->order_id) &&
    // !empty($data->productId) &&
    // !empty($data->quantity) 
)

{
     $insert_order->userId = $data->userId;
     $insert_order->sellerId = $data->sellerId;
     $insert_order->paymentId = $data->paymentId;

     $insert_order->orderId = $data->orderId;
     $insert_order->total = $data->total;
     $insert_order->adminCommision = $data->adminCommision;

     $insert_order->createdBy = $data->createdBy;


       
    //var_dump($exam);
    // create the reg
    if($insert_order->insertOrder() ){

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