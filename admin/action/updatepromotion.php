<?php 
include '../../constant.php';

// Get input data from POST request
$id = $_POST['id'];
$status = 1;
$tHeading = trim(strtoupper($_POST['tHeading']));
$heading = trim(strtoupper($_POST['heading']));
$link = trim(strtoupper($_POST['link']));
$para = trim(strtoupper($_POST['para'])); 
$updatedOn = date('Y-d-m h:i:sa');
$updatedBy = "Admin";

// Set the URL for the API
$url = $URL . "promotion/updatepromotion.php";

// Prepare the data to be sent in the POST request
$data = array(
    "id" => $id,
    "tHeading" => $tHeading,
    "heading" => $heading,
    "link" => $link,
    "status" => $status,
    "para" => $para,
    "updatedOn" => $updatedOn,
    "updatedBy" => $updatedBy
);
//print_r($data);
// Encode the data into JSON
$postdata = json_encode($data);

// Initialize the cURL session
$client = curl_init($url);

// Set cURL options
curl_setopt($client, CURLOPT_POSTFIELDS, $postdata);
curl_setopt($client, CURLOPT_CONNECTTIMEOUT, 0); // Connection timeout (in seconds)
curl_setopt($client, CURLOPT_TIMEOUT, 4); // Timeout for the request (in seconds)
curl_setopt($client, CURLOPT_RETURNTRANSFER, true); // Return the response as a string

// Execute the cURL request and capture the response
$response = curl_exec($client);
// print_r($response);
// Check if the cURL request was successful
if (curl_errno($client)) {
    // cURL error occurred
    $error_message = curl_error($client);
    echo json_encode(array("message" => "Error: " . $error_message));
} else {
    // No cURL error, process the response
    $result_registration = json_decode($response, true);
    
    // Check the response status and respond accordingly
    if ($result_registration->message == "successfully") {
        // If the response contains a success message
        echo json_encode(array("message" => "Promotion updated successfully."));
        // header('Location:../managepromotion.php');
    } else {
        // If the response doesn't contain a success message
        echo json_encode(array("message" => "Failed to update promotion. Please try again."));
        // header('Location:../managepromotion.php');

    }
}

// Close the cURL session
curl_close($client);

?>
