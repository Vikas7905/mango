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
$read_users->email = $data->email;
$read_users->password = $data->password;
if ($read_users->email!="" && $read_users->password) {

    try {

        $stmt = $read_users->readUser();
        $num = $stmt->rowCount();

        // check if more than 0 record found
        if ($num > 0) {

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $pass = $read_users->password;
                if ($pass === $password) {
                    $secret_key = $SECRET_KEY;
                    $issuer_claim = "GAURI_AAM_WALA"; // this can be the servername
                    $audience_claim = "ALL";
                    $issuedat_claim = time(); // issued at
                    $notbefore_claim = $issuedat_claim ; //not before in seconds
                    $expire_claim = $issuedat_claim + 3600*24*365; // expire time in seconds
                    $token = array(
                        "iss" => $issuer_claim,
                        "aud" => $audience_claim,
                        "iat" => $issuedat_claim,
                        "nbf" => $notbefore_claim,
                        "exp" => $expire_claim,
                        "data" => array(
                            "name" => $name,
                            "phoneNo" => $phoneNo,
                            "email" => $email,
                            "createdOn" => $createdOn
                        )
                    );

                    $jwt = JWT::encode($token, $secret_key);
                     echo json_encode(
                        array(
                            "message" => "Successfull",
                            "jwt" => $jwt,
                            "email" => $email,
                            "name"=>$name,
                            "createdOn"=>$createdOn,
                            "expireAt" => $expire_claim
                        )
                    );

                    // set response code - 200 OK
                    http_response_code(200);
                }
            }
        }
        else{
            http_response_code(201);
            echo json_encode(array(
                "message" => "No Records"
            ));
        }


    } catch (Exception $e) {

        http_response_code(401);
        echo json_encode(array(
            "message" => "Access denied.",
            "error" => $e->getMessage()
        ));
    }

}


?>