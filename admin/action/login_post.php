<?php
session_start();
include '../../constant.php';
include_once '../../api/objects/curl.php';
require '../../api/php-jwt/src/JWT.php';
require '../../api/php-jwt/src/ExpiredException.php';
require '../../api/php-jwt/src/SignatureInvalidException.php';
require '../../api/php-jwt/src/BeforeValidException.php';
use \Firebase\JWT\JWT;

$pwd = $_POST["password"];
$email = $_POST["email"];
$url = $URL . "user/read_userById.php";

$data = array("password" => $pwd, "email" => $email);
$postdata = json_encode($data);

$readCurl = new Curl();
$response = $readCurl->createCurl($url, $postdata, 0, 10, 1);
$result = json_decode($response);

if ($result->message == "Successfull") {
    try {
        $decoded = JWT::decode($result->jwt, $SECRET_KEY, array('HS256'));
        $currentTime = time();
        
        if ($decoded->exp > $currentTime) {
            $_SESSION['decoded'] = $decoded;
            session_regenerate_id(true); // Regenerate session ID for security
            $_SESSION["JWT"] = $result->jwt;
            $_SESSION["phoneNo"] = $decoded->data->phoneNo;
            $_SESSION["name"] = $decoded->data->name;
            header('Location:../../index.php');
            exit;
        } else {
            // If JWT expired
            header('Location:../../login.php?msg=Token expired');
            exit;
        }
    } catch (Exception $e) {
        // If decoding fails
        header('Location:../../login.php?msg=Invalid token');
        exit;
    }
} else {
    header('Location:../../login.php?msg=Username or password is incorrect');
    exit;
}
?>
