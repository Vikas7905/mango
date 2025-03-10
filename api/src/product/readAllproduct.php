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

// initialize object
$read_product = new Product($db);
  
$data = json_decode(file_get_contents("php://input"));
$read_product->productType=($data->productType);


if(true){

    try {


$stmt = $read_product->readAllProductDetails();
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){
  
    // products array
    $read_product_arr=array();
    $read_product_arr["records"]=array();


    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
     
        extract($row);
       // print_r($row);
  
        $read_product_item=array(

            
           // "skuId"=>$skuId,
           "skuId"=>$skuId,
           "id"=>$id,
           "name"=>$name,
           "productName"=>$productName,
           "price"=>$price,
           "quantity"=>$quantity,
           "description"=>$description,
           "categoriesId"=>$categoriesId,
           "image"=>$image,
           "discount"=>$discount,
           "sellerId"=>$sellerId,
           "sellerName"=>$sellerName,
           "shippingCharge"=>$shippingCharge
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
          http_response_code(402);
      
          echo json_encode(array(
              "message" => "Access denied.",
              "error" => $e->getMessage()
          ));
      }
      
  }  
// no products found will be here
?>