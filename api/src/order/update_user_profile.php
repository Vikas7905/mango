<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// get database connection
include_once '../../config/database.php';
  
//instantiate reg object
include_once '../../objects/user.php';
  
$database = new Database();
$db = $database->getConnection();
  
$update_userprofile = new User($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));
// print_r($data);
// mavarke sure data is not empty
if(
   
    !empty($data->userId) &&     
    !empty($data->businessName) &&
    !empty($data->businessCategory) &&
    !empty($data->userAddress) &&
    !empty($data->establishmentYear) &&
    !empty($data->businessTiming) &&
    !empty($data->paymentMode) &&
    !empty($data->userServices) &&
    !empty($data->aboutUser) 
  
)

{
    $update_userprofile->userId=$data->userId;
    $update_userprofile->aboutUser=$data->aboutUser;
    $update_userprofile->businessName=$data->businessName;
    $update_userprofile->businessCategory = $data->businessCategory;
    $update_userprofile->userAddress = $data->userAddress;
    $update_userprofile->city = $data->city;
    $update_userprofile->state = $data->state;
    $update_userprofile->alterMobile = $data->alterMobile;
    $update_userprofile->establishmentYear = $data->establishmentYear;
    $update_userprofile->businessTiming = $data->businessTiming;
    $update_userprofile->businessDay = $data->businessDay;
    $update_userprofile->paymentMode = $data->paymentMode;
    $update_userprofile->userWebsite = $data->userWebsite;
    $update_userprofile->userServices = $data->userServices;
    $update_userprofile->status = $data->status;
    $update_userprofile->remark = $data->remark;
    $update_userprofile->updatedOn = $data->updatedOn;
    $update_userprofile->updatedBy = $data->updatedBy;

    if($update_userprofile->updateUserProfile()){
  
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("message" => "User profile updated successfully"));
    }
  
    // if unable to create the reg, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Unable to update user Profile"));
    }
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "Unable to update user Profile. Data is incomplete."));
}
?>