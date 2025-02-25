<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/database.php';
include_once '../../objects/paymentdetails.php';
// get database connection
  
$database = new Database();
$db = $database->getConnection();
  
$insert_paymentDetails = new Paymentdetails($db);
  
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
    $insert_paymentDetails-> orderId = $data->orderId;
    $insert_paymentDetails->amount = $data->amount;
    $insert_paymentDetails->refundId = $data->refundId;
    $insert_paymentDetails->paymentMode = $data->paymentMode;
    $insert_paymentDetails->status = $data->status;
    $insert_paymentDetails->createdOn = $data->createdOn;
    $insert_paymentDetails->createdBy = $data->createdBy;
        
    //var_dump($exam);
    // create the reg
    if($insert_paymentDetails->insertpaymentdetails()){

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