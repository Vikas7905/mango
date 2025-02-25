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
//print_r($read_order);
$data = json_decode(file_get_contents("php://input"));
$read_order->userId = $data->userId;
$read_order->paymentId = $data->paymentId;
// $read_allusers->userId = $data->userId;
// echo "********************";
// print_r($data);

//$getHeaders = apache_request_headers();
//print_r($getHeaders);
// $jwt = $getHeaders['Authorization'];

if ($read_order->userId!="") {

    try {

        // $decoded = JWT::decode($jwt, $SECRET_KEY, array('HS256'));

        $stmt = $read_order->readOrdersById();
        $num = $stmt->rowCount();

        // check if more than 0 record found
        if ($num > 0) {

            // products array
            $read_order_arr = array();
            $read_order_arr["records"] = array();


            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                extract($row);

                $read_order_item = array(


                    "userId" => $userId,
                    "orderId" => $orderId,
                    "productId" => $productId,
                    "paymentId"=>$paymentId,
                    "name"=>$name,
                    "subId"=>$subId,
                    "pName"=>$pName,
                    "productSkuId" => $productSkuId,
                    "quantity" => $quantity,

                    "discount" => $discount,
                    "price" => $price,
                    "itemTotal" => $itemTotal,
                   
                    "orderTotal" => $orderTotal,
                    "deliveryId" => $deliveryId,
                    "sellerId" => $sellerId,
                    "sellerName"=>$sellerName,
                    "status" => $status,

                    "sgst"=>$sgst,
                    "cgst"=>$cgst,
                    "sgstOrder"=>$orderSGST,
                    "cgstTotal"=>$orderCGST,

                    "deliveryAddress" => $deliveryAddress,
                    "deliveryInstruction" => $deliveryInstruction,
                    "createdBy"=>$createdBy,
                    "totalQuantity"=>$totalQuantity,
                    "createdOn"=>$createdOn

                );

                array_push($read_order_arr["records"], $read_order_item);
            }

            // show products data in json format
            echo json_encode($read_order_arr);

            // set response code - 200 OK
            http_response_code(200);
        }
    } catch (Exception $e) {
        print_r($e);
        http_response_code(402);

        echo json_encode(array(
            "message" => "Access dsenied.",
            "error" => $e->getMessage()
        ));
    }

}


?>