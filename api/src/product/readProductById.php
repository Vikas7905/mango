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

$data = json_decode(json: file_get_contents("php://input"));
$read_product->catId = $data->crid;
$read_product->pid = $data->pid;
$read_product->pincode = isset($data->pincode)?($data->pincode):"";
$read_product->subCat = $data->spid;
$read_product->sort = $data->sort;
$read_product->pageSize = $data->pageSize;
$read_product->filter = $data->filter;
$read_product->extra = $data->extra;

// echo convert_uudecode(base64_decode($data->filter));
 //$cond = explode("_", convert_uudecode(base64_decode($data->filter)));
// print_r($data);
if ($data->filter != "") {

     $cond = explode("_", convert_uudecode(base64_decode($data->filter)));
    //  print_r($cond);
    $x=explode("&", $cond[0]);
    if (str_contains($cond[0], "GE") && str_contains($cond[0], "LE")) {
      

        $read_product->minVal = str_contains($cond[0], "GE") ? explode("GE",$x[0])[1]:0;
        $read_product->maxVal = str_contains($cond[0], "LE") ? explode("LE",$x[1])[1]:0;
    } else if (str_contains($cond[0], "GE")) {
        $read_product->minVal = str_contains($cond[0], "GE") ? explode("GE",$x[0])[1]:0;
        $read_product->maxVal = 100000;
    } else if (str_contains($cond[0], "LE")) {
        $read_product->minVal = 0;
        $read_product->maxVal = str_contains($cond[0], "LE") ?explode("LE",$x[0])[1]:0;
    }
}



//$getHeaders = apache_request_headers();
//print_r($data);
$jwt = "123";

if (true) {

    try {

        //  $decoded = JWT::decode($jwt, $SECRET_KEY, array('HS256'));
// $read_allusers->userType = $data->userType;
// $read_allusers->status = $data->status;
// $read_allusers->userId = $data->userId;

        //print_r(value: $data);

        $stmt = $read_product->readProductById();

        $num = $stmt->rowCount();
        //echo $num; 
// check if more than 0 record found
        if ($num > 0) {

            // products array
            $read_product_arr = array();
            $read_product_arr["records"] = array();


            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                extract($row);

                $read_product_item = array(

                    "skuId" => $skuId,
                    "pid" => $id,
                    "productName" => $name,
                    "price" => $price,
                    "quantity" => $quantity,
                    "sellerId" => $sellerId,
                    // "sellerName" => $sellerName, 
                    "shippingCharge" => $shippingCharge,
                    "discount" => $discount,
                    "categoriesId" => $categoriesId,
                    "rating" => $rating,
                    "sgst" =>$sgst,
                    "cgst" =>$cgst,
                    "description" => $description
                );
                array_push($read_product_arr["records"], $read_product_item);
            }

            // show products data in json format
            echo json_encode($read_product_arr);

            // set response code - 200 OK
            http_response_code(200);
        }

    } catch (Exception $e) {
        // print_r($e);
        http_response_code(405);

        echo json_encode(array(
            "message" => "Access denied.",
            "error" => $e->getMessage()
        ));
    }

}
// no products found will be here

?>