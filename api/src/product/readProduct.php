<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../../config/database.php';
include_once '../../objects/product.php';

$database = new Database();
$db = $database->getConnection();

$read_product = new Product($db);

// Get data from POST request
$data = json_decode(file_get_contents("php://input"));
$catId = isset($data->catId) ? $data->catId : "";
$page = isset($data->page) ? $data->page : 1;
$sort = isset($data->sort) ? $data->sort : "";
$read = isset($data->read) ? $data->read : "";
$search = isset($data->search) ? $data->search : "";
$limit = 5; // Fetch 5 products per request
$offset = ($page - 1) * $limit;

try {
    // Fetch products from the database with pagination
    $stmt = $read_product->readProduct($limit, $offset, $catId, $sort, $search, $read);
    $num = $stmt->rowCount();

    if ($num > 0) {
        $product_arr = array();
        $product_arr["records"] = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $product_item = array(
                "id" => $id,
                "productName" => $productName,
                "skuId" => $skuId,
                "categoriesId" => $categoriesId,
                "description" => $description,
                "price" => $price,
                "discount" => $discount,
                "image" => $image
            );
            array_push($product_arr["records"], $product_item);
        }

        echo json_encode($product_arr);
        http_response_code(200);
    } else {
        echo json_encode(array("message" => "No products found"));
        http_response_code(404);
    }
} catch (PDOException $e) {
    // Handle PDO exceptions (e.g., database connection issues or query problems)
    echo json_encode(array("message" => "Error: " . $e->getMessage()));
    http_response_code(500);
} catch (Exception $e) {
    // Handle other exceptions
    echo json_encode(array("message" => "Unexpected Error: " . $e->getMessage()));
    http_response_code(500);
}
?>
