<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/database.php';
include_once '../../objects/deliveryincome.php';
include_once '../../constant.php';


// get database connection
  
$database = new Database();
$db = $database->getConnection();
  
$insert_DeliveryIncome = new Deliveryincome($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));
$getHeaders = apache_request_headers();
//print_r($getHeaders);
$jwt = "123";

if($jwt){

    try {

         //$decoded = JWT::decode($jwt, $SECRET_KEY, array('HS256'));
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
    $insert_DeliveryIncome->deliveryId = $data->deliveryId;
    $insert_DeliveryIncome->orderId = $data->orderId;
    $insert_DeliveryIncome->sellerId = $data->sellerId;
    $insert_DeliveryIncome->amount = $data->amount;
    $insert_DeliveryIncome->commision = $data->commision;
    $insert_DeliveryIncome->otherCommision = $data->otherCommiion;
    $insert_DeliveryIncome->fuelCharges = $data->fuelCharges;
    $insert_DeliveryIncome->tipAmount = $data->tipAmoun;
    $insert_DeliveryIncome->createdOn = $data->createdOn;
    $insert_DeliveryIncome->createdBy = $data->createdBy;

       
    //var_dump($exam);
    // create the reg
    if($insert_DeliveryIncome->insertDeliveryIncome()){

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