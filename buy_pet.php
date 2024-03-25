<?php

include_once "http.php";

header("Content-Type: application/json");

// Read the incoming JSON data
$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);
include_once './db/connection.php';

if ($data!=null) {
    // Process the received JSON data

    // INSERT INTO `user`(`id`, `name`, `user_name`, `pass`, `email`,`created_at`) VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]')

    $id = 0;
    // if (isset($_GET['id'])) {
    //     $id = (int)$_GET['id'];
    // }
    $id =(int) $data['petId']; 
    $senderEmail = $data['senderEmail']; 
    $status = (int)$data['status']; 




    if ($id > 0) {
        $sql = "UPDATE `animal` SET `status`=$status WHERE animal.id=$id";
    } else {
        exit;
    }



    $res = mysqli_query($con, $sql);


    $data = array();


    mysqli_close($con);

    // Perform any necessary database or business logic operations here

    // Return a response
    $response = array(
        'error' => false,
        'data' => "Adopted Successfully !"
    );
} else {
    // Error in decoding JSON data
    $response = array(
        'error' => true,
        'message' => 'JSON Should not be empty'
    );
}

// Send JSON response back to the client
echo json_encode($response);
