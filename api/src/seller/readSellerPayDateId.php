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
include_once '../../objects/seller.php';
//require "../../vendor/autoload.php";
include_once '../../constant.php';


// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
//print_r($db);
  
// initialize object
$read_seller = new Seller($db);
  
$data = json_decode(file_get_contents("php://input"));
$fromDate = $read_seller->fromDate = $data->fromDate;
$toDate = $read_seller->toDate = $data->toDate;
$read_seller->sellerId = $data->sellerId;
// $read_allusers->status = $data->status;
// $read_allusers->userId = $data->userId;
// print_r($_SERVER);
$getHeaders = apache_request_headers();
//print_r($getHeaders);
$jwt ="123";

// $arr = explode(" ", $authHeader);


// echo json_encode(array(
//     "message" => "sd" .$arr[1]
// ));

// $jwt = $arr[1];

if($jwt){

    try {

         //$decoded = JWT::decode($jwt, $SECRET_KEY, array('HS256'));
         //$decoded = JWT::decode($jwt, $SECRET_KEY);

    
 //print_r($data);

$stmt = $read_seller->readSellerPayDateId($fromDate, $toDate);
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){
  
    // products array
    $read_seller_arr=array();
    $read_seller_arr["records"]=array();


    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
     
        extract($row);
  
        $read_seller_item=array(

            
            // "sellerName"=>$sellerName,
            // "counterName"=>$counterName,
            // "phoneNo"=>$phoneNo,
            // "email"=>$email,
            // "pan"=>$pan,
            // "password"=>$password,
            // "createdOn"=>$createdOn,
            // "id"=>$id,
            // "city"=>$city,
            // "address"=>$address,
            // "pincode"=>$pincode,
            // "aadhar"=>$aadhar,
            // "adminCommision"=>$adminCommision,
            // "sTotal"=>$sTotal,
            // "sub"=>$sub,
            // "discount"=>$discount,

            // "todaysTotal"=>$todaysTotal,
            // // "todaysDiscount"=>$todaysDiscount,
            // // "todaysCommision"=>$todaysCommision

            "sellerId"=>$sellerId,
            "sellerName"=>$sellerName,
            "counterName"=>$counterName,
            "email"=>$email,
            "phoneNo"=>$phoneNo,
            "sellerId"=>$sellerId,
            "quantity"=>$quantity,
            "totalSubtotal"=>$total_subtotal,
            "total_discount"=>$total_discount,
            "total_after_discount"=>$total_after_discount,
            "totalAdminCommission"=>$total_admin_commission,
            "payAble"=>$payAble,
            "cgst"=>$cgst,
            "sgst"=>$sgst
        );
  
        array_push($read_seller_arr["records"], $read_seller_item);
    }

    // show products data in json format
    echo json_encode($read_seller_arr);

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