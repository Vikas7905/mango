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
include_once '../../objects/product.php';
include_once '../../constant.php';



  
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
//print_r($db);
  
// initialize object
$read_product = new Product($db);
  
$data = json_decode(file_get_contents("php://input"));
$read_product->skuId = $data->skuId;
$getHeaders = apache_request_headers();
//print_r($getHeaders);
$jwt = "123";

if($jwt){

    try {

        //  $decoded = JWT::decode($jwt, $SECRET_KEY, array('HS256'));
// $read_allusers->userType = $data->userType;
// $read_allusers->status = $data->status;
// $read_allusers->userId = $data->userId;

 //print_r($data);

$stmt = $read_product->readProductById();
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){
  
    // products array
    $read_product_arr=array();
    $read_product_arr["records"]=array();


    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
     
        extract($row);
  
        $read_product_item=array(

            
            "skuId"=>$skuId,
            "name"=>$name,
            "categoriesId"=>$categoriesId,
            "price"=>$price,
            "discount"=>$discount,
            "description"=>$description,
            "image"=>$image
        );
  
        array_push($read_product_arr["records"], $read_product_item);
    }

    // show products data in json format
    echo json_encode($read_product_arr);

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