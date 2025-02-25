<?php
// required headers
include '../curl_header.php';
use \Firebase\JWT\JWT;
//database connection will be here

// include database and object files
include_once '../../config/database.php';
include_once '../../objects/user.php';
include_once '../../constant.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
// print_r($db);

// initialize object
$read_users = new User($db);
// print_r($read_users);

$data = json_decode(file_get_contents("php://input"));
$read_users->email = $data->user;
if ($read_users->email!="" ) {

    try {

        $stmt = $read_users->readUserAddress();
        $num = $stmt->rowCount();

        // check if more than 0 record found
        if ($num > 0) {

            $read_users_arr=array();
            $read_users_arr["records"]=array();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
     
                extract($row);
          
                $read_users_item=array(
        
                    "id"=>$id,
                    "addressLine1"=>$addressLine1,
                    "addressLine2"=>$addressLine2,
                    "name"=>$name,
                    "mobile"=>$mobile,
                    "city"=>$city,
                    "landmark"=>$landmark,
                    "state"=>$state,
                    "postalCode"=>$postalCode,
                    "email"=>$userId
                    );
          
                array_push($read_users_arr["records"], $read_users_item);
            }
             // show products data in json format
    echo json_encode($read_users_arr);

    // set response code - 200 OK
    http_response_code(200);
        }


    } catch (Exception $e) {
print_r($e);
        http_response_code(401);
        echo json_encode(array(
            "message" => "Access denied.",
            "error" => $e->getMessage()
        ));
    }

}

?>