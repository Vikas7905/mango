<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
//database connection will be here

// include database and object files
include_once '../../config/database.php';
include_once '../../objects/order.php';
include_once '../../constant.php';



  
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$read_order = new Order($db);
  
$data = json_decode(file_get_contents("php://input"));
 $read_order->userId = $data->userId;
 $read_order->paymentResponse= $data->paymentId;
// $read_allusers->userId = $data->userId;

//print_r($data);

$getHeaders = apache_request_headers();
//print_r($getHeaders);
$jwt = $getHeaders['Authorization'];

if($jwt){

    try {

         //$decoded = JWT::decode($jwt, $SECRET_KEY, array('HS256'));

$stmt = $read_order->readOrder();
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){
  
    // products array
    $read_order_arr=array();
    $read_order_arr["records"]=array();


    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
     
        extract($row);
  
        $read_order_item=array(

            
            "userId"=>$userId,
            "orderID"=>$orderId,
            "productId"=>$productId,

            "productSkuId"=>$productSkuId,
,            "quantity"=>$quantity,

            "discount"=>$discount,
            "price"=>$price,
            "itemTotal"=>$itemTotal,

            "orderTotal"=>$orderTotal,
            "deliveryBoyId"=>$deliveryBoyId,

            "deliveryId"=>$deliveryId,
            "sellerId"=>$sellerId,
            "status"=>$status,

            "deliveryAddress"=>$deliveryAddress,
            "deliveryInstruction"=>$deliveryInstruction

        );
  
        array_push($read_order_arr["records"], $read_order_item);
    }

    // show products data in json format
    echo json_encode($read_order_arr);

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