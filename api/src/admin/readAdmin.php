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
include_once '../../objects/admin.php';
include_once '../../constant.php';


$issuedat_claim = time(); // issued at
$notbefore_claim = $issuedat_claim ; //not before in seconds
$expire_claim = $issuedat_claim + 1800; // expire time in seconds
  
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
//print_r($db);
  
// initialize object
$read_admin = new Admin($db);
  
$data = json_decode(file_get_contents("php://input"));
// $read_allusers->userType = $data->userType;
// $read_allusers->status = $data->status;
// $read_allusers->userId = $data->userId;

 //print_r($data);

$stmt = $read_admin->readAdmin();
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){
    if ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // var_dump($row);
         extract($row);
     $token = array(
             "iss" => $ISSUER_CLAIM,
             "aud" => $AUDIENCE_CLAIM,
             "iat" => $issuedat_claim,
             "nbf" => $notbefore_claim,
             "exp" => $expire_claim,
             "data" => array(
                 "message" => $LOGIN_SUCCESS_MSG,
                 "userName" => $username,
                 "password" =>$password
                 
                
         ));
     //var_dump($token);
    $jwt = JWT::encode($token, $SECRET_KEY);     
    
         echo json_encode(
             array(
                 "token" => $jwt
             ));
     }
    
         http_response_code(200);
    // products array
    $read_admin_arr=array();
    $read_admin_arr["records"]=array();


    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
     
        extract($row);
  
        $read_admin_item=array(

            
            "userId"=>$username,
            "productId"=>$password
           
        );
  
        array_push($read_admin_arr["records"], $read_admin_item);
    }


    // show products data in json format
    //echo json_encode($read_admin_arr);

     // set response code - 200 OK
     http_response_code(200);
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