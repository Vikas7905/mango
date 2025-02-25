<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// include database and object file
include_once '../../config/database.php';
include_once '../../objects/productview.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare admin object
$delete_productview = new Productviews($db);
  
// get admin id
$data = json_decode(file_get_contents("php://input"));
//print_r($data);  

// set admin id to be deleted
$delete_productview->productId = $data->productId;
  
// delete the admin
if($delete_productview->deleteProductView()){
  
    // set response code - 200 ok
    http_response_code(200);
  
    // tell the user
    echo json_encode(array("message" => "Delivery Boy has been deleted."));
}
  
// if unable to delete the admin
else{
  
    // set response code - 503 service unavailable
    http_response_code(503);
  
    // tell the user
    echo json_encode(array("message" => "Unable to delete Record."));
}
?>