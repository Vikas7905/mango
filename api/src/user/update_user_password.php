<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// get database connection
include_once '../../config/database.php';
include_once '../../objects/user.php';
include_once '../../constant.php';


  
$database = new Database();
$db = $database->getConnection();
  
$update_user = new User($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));
$update_user->email=$data->email;
$getHeaders = apache_request_headers();
//print_r($getHeaders);
$jwt = "123";

if($jwt){

    try {

        //$decoded = JWT::decode($jwt, $SECRET_KEY, array('HS256'));
// mavarke sure data is not empty
if(1
    // !empty($data->id) &&
    // !empty($data->password)
)

{
    $update_user->password=$data->password;
   
    if($update_user->updateUserPassword()){
  
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("message" => "Update successfully"));
    }
    
  
    // if unable to create the reg, tell the userx1
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Unable to Update user"));
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