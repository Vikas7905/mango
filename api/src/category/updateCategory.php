<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// get database connection
include_once '../../config/database.php';
include_once '../../objects/category.php';
include_once '../../constant.php';



  
$database = new Database();
$db = $database->getConnection();
  
$update_Category = new Category($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));
$update_Category->id = $data->id;
$getHeaders = apache_request_headers();
//print_r($getHeaders);
$jwt = "123";

if($jwt){

    try {

        // $decoded = JWT::decode($jwt, $SECRET_KEY, array('HS256'));


 //print_r($data);
// mavarke sure data is not empty
if(1
    // !empty($data->id) &&
    // !empty($data->password)
)

{
    $update_Category->name=$data->name;
    $update_Category->cgst=$data->cgst;
    $update_Category->sgst=$data->sgst;
    $update_Category->commision=$data->commision;
    $update_Category->updatedOn=$data->updatedOn;
    
    if($update_Category->updateCategory()){
  
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
        echo json_encode(array("message" => "Category Not Updated"));
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