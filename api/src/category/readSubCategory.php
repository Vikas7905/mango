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
include_once '../../objects/category.php';
include_once '../../constant.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
//print_r($db);
  
// initialize object
$read_category = new Category($db);
  
$data = json_decode(file_get_contents("php://input"));
$getHeaders = apache_request_headers();
//print_r($getHeaders);
$jwt = "123";

if($jwt){

    try {

$stmt = $read_category->readCategoriesWithSub();
//print_r($stmt);
$num = $stmt->rowCount();
//print_r($num);
  
// check if more than 0 record found
if($num>0){
  
    // products array
    $read_category_arr=array();
    $read_category_arr["records"]=array();

    //$categories = array();;
    $groupedData = [];

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $categoryId = $name;
        if (!isset($groupedData[$categoryId])) {
            $groupedData[$categoryId] = [
                'id' => $id,
                'name' => $name,
                'categoriesImage' => $categoriesImage,
                'commision' => $commision,
                'description' => $description,
                'status' => $status,
                'createdOn' => $createdOn,
                'updatedOn' => $updatedOn,
                'createdBy' => $createdBy,
                'subcategories' => []
            ];
        }
    
        // Add the subcategory to the category
        $groupedData[$categoryId]['subcategories'][] = [
            'subId' => $subId,
            'subName' => $subName,
            'description'=>$description
        ];
    
      
  
      
    }
      array_push($read_category_arr["records"], $groupedData);

    // show products data in json format
    echo json_encode($read_category_arr);

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