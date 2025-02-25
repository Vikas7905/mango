<?php
// required headers
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
//database connection will be here

// include database and object files
include_once '../../config/database.php';
include_once '../../objects/deliveryBoy.php';
include_once '../../constant.php';




  
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
//print_r($db);
  
// initialize object
$read_deliveryBody = new DeliveryBoy($db);
  
$data = json_decode(file_get_contents("php://input"));

//$read_deliveryBody->id = $data->id;
$getHeaders = apache_request_headers();
//print_r($getHeaders);
$jwt = "123";

if($jwt){

    try {

        //$decoded = JWT::decode($jwt, $SECRET_KEY, array('HS256'));
// $read_allusers->status = $data->status;
// $read_allusers->userId = $data->userId;

 //print_r($data);

 $stmt = $read_deliveryBody->readDeliveryBoy();
 $num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){
  
    // products array
    $read_delivery_arr=array();
    $read_delivery_arr["records"]=array();


    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
     
        extract($row);
  
        $read_delivery_item=array(

            
            "name"=>$name,
            "phoneNo"=>$phoneNo,
            "email"=>$email,
            "workingAddress"=>$workingAddress,
            "regidenceAddress"=>$regidenceAddress,
            "workingPincode"=>$workingPincode,
            "city"=>$city,
            "status"=>$status,
            "aadhar"=>$aadhar,
            "password"=>$password,
            "id"=>$id,
            "pan"=>$pan,
            "image"=>$image,
            "createdOn"=>$createdOn,
            "createdBy"=>$createdBy
        );
  
        array_push($read_delivery_arr["records"], $read_delivery_item);
    }

    // show products data in json format
    echo json_encode($read_delivery_arr);

     // set response code - 200 OK
     http_response_code(200);
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
// no products found will be here
else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no products found
    echo json_encode(
        array("message" => "No user list found.")
    );
}
?>