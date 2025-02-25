<?php
session_start();
include '../../constant.php';
include_once '../../api/objects/curl.php';
$email = $_POST["email"];
$url = $URL . "user/read_userByIdReset.php";
$data = array("email" => $email);
$postdata = json_encode($data);
$readCurl = new Curl();
$response = $readCurl->createCurl($url, $postdata, 0, 10, 1);
$result = (json_decode($response));
//print_r($result);
if ($result->records[0]->message == "Successfull") {
    $to = $email;//$result->email; // Recipient's email address
    $subject = "Password Reset Request For Online Sabji Mandi"; // Subject of the email
    $message = "Hello " . $result->records[0]->name . ",<br> Your account password is ." . $result->records[0]->password; // Message body
    $headers = "From: admin@shivammangoshop.com"; // Sender's email address

    if (mail($to, $subject, $message, $headers)) {
        header('Location:../../accountphp?msg=Email sent successfully');
    } else {
        header('Location:../../accountphp?msg=Failed to send email');
    }
} else {
    header('Location:../../forgot-password.php?msg=Username  is incorrect');
}


?>